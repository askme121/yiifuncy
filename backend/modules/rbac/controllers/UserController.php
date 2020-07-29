<?php

namespace rbac\controllers;

use Yii;
use rbac\models\form\PasswordResetRequest;
use rbac\models\form\ResetPassword;
use rbac\models\form\Signup;
use rbac\models\form\ChangePassword;
use backend\models\Admin;
use rbac\models\searchs\User as UserSearch;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\base\UserException;
use yii\mail\BaseMailer;
use yii\web\ForbiddenHttpException;

class UserController extends Controller
{
    private $_oldMailPath;

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'active' => ['post'],
					'inactive' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            if (Yii::$app->has('mailer') && ($mailer = Yii::$app->getMailer()) instanceof BaseMailer) {
                $this->_oldMailPath = $mailer->getViewPath();
                $mailer->setViewPath('@rbac/mail');
            }
            return true;
        }
        return false;
    }

    public function afterAction($action, $result)
    {
        if ($this->_oldMailPath !== null) {
            Yii::$app->getMailer()->setViewPath($this->_oldMailPath);
        }
        return parent::afterAction($action, $result);
    }

    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
			'model' => $this->findModel($id),
        ]);
    }

    public function actionDelete($id)
    {
		if($this->findModel($id)->delete()){
			return json_encode(['code'=>200, "msg"=>"删除成功"]);
		}else{
			return json_encode(['code'=>400, "msg"=>"删除失败"]);
		}
    }
	
    public function actionActive($id)
    {
		$model = $this->findModel($id);
		if($model->status== Admin::STATUS_ACTIVE){
			return json_encode(['code'=>400,"msg"=>"该用户是已经是启用状态"]);
		}
		
		$model->status = Admin::STATUS_ACTIVE;
		
		if($model->save()){
			return json_encode(['code'=>200,"msg"=>"启用成功"]);
		}else{
			$errors = $model->firstErrors;
			return json_encode(['code'=>400,"msg"=>reset($errors)]);
		}
    }
	
    public function actionInactive($id)
    {	
		$model = $this->findModel($id);
		if($model->status== Admin::STATUS_INACTIVE){
			return json_encode(['code'=>400,"msg"=>"该用户是已经是禁用状态"]);
		}
		
		$model->status = Admin::STATUS_INACTIVE;
		
		if($model->save()){
			return json_encode(['code'=>200,"msg"=>"禁用成功"]);
		}else{
			$errors = $model->firstErrors;
			return json_encode(['code'=>400,"msg"=>reset($errors)]);
		}
    }
	
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $post_data = Yii::$app->request->post();

        if ($model->load($post_data)) {
            if ($model->validate()){
                if($post_data['Admin']['password_hash']){
                    $model->password_hash = Yii::$app->security->generatePasswordHash($post_data['Admin']['password_hash']);
                }
                $model->password_reset_token = null;
                $model->updated_at = time();
                if($model->save()){
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                return json_encode(['code'=>400,"msg"=>'验证不通过']);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
	
    public function actionUpdateSelf($id)
    {
        $model = $this->findModel($id);
        $post_data = Yii::$app->request->post();
		
		if ($id != Yii::$app->user->identity->id){
			throw new ForbiddenHttpException('你没有权限修改');
		}
        if ($model->load($post_data) && $model->validate()) {
			if($post_data['Admin']['password_hash']){
				$model->password_hash = Yii::$app->security->generatePasswordHash($post_data['Admin']['password_hash']);
			}
            $model->password_reset_token = null;
            $model->updated_at = time();
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('update_self', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->getUser()->logout();
        return $this->goHome();
    }

    public function actionSignup()
    {
        $model = new Signup();
        if ($model->load(Yii::$app->getRequest()->post())) {
            if ($user = $model->signup()) {
				return $this->render('view', [
					'model' => $user,
				]);
            }
        }

        return $this->render('signup', [
                'model' => $model,
        ]);
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequest();
        if ($model->load(Yii::$app->getRequest()->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }
        return $this->render('requestPasswordResetToken', [
                'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPassword($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->getRequest()->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');
            return $this->goHome();
        }

        return $this->render('resetPassword', [
                'model' => $model,
        ]);
    }

    public function actionChangePassword()
    {
        $model = new ChangePassword();
        if ($model->load(Yii::$app->getRequest()->post()) && $model->change()) {
            return $this->goHome();
        }

        return $this->render('change-password', [
                'model' => $model,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Admin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
