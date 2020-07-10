<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use rbac\models\form\Login;
use rbac\models\Role;
use common\models\SmallImage;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'test', 'clear', 'change'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $sql1='SELECT
					ip,
					FROM_UNIXTIME(created_at, "%Y-%m-%d"),
					COUNT(*) as num
				FROM
					t_admin_log
				WHERE
					FROM_UNIXTIME(created_at, "%Y-%m-%d") = date_format(NOW(), "%Y-%m-%d")
				GROUP BY
					ip';
        $rows1=Yii::$app->db->createCommand($sql1)->query();
        $x1 = [];
        $y1 = [];
        foreach($rows1 as $value){
            $x1[]=$value['ip'];
            $y1[]=$value['num'];
        }

        $sql = 'SELECT
					FROM_UNIXTIME(created_at, "%Y-%m-%d") as date,
					COUNT(*) as num
				FROM
					t_admin_log
				GROUP BY
					FROM_UNIXTIME(created_at, "%Y-%m-%d")';
        $rows=Yii::$app->db->createCommand($sql)->query();
        $x = [];
        $y = [];
        foreach($rows as $value){
            $x[]=$value['date'];
            $y[]=$value['num'];
        }
        return $this->render('index', ["data"=>['x'=>$x,'y'=>$y,'x1'=>$x1,'y1'=>$y1]]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new Login();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionClear()
    {
        $res = Yii::$app->cache->flush();
        if ($res){
            return json_encode(['code'=>200,"msg"=>"刷新成功"]);
        } else {
            return json_encode(['code'=>0,"msg"=>"刷新失败"]);
        }
    }

    public function actionChange()
    {
        $site_id = \Yii::$app->request->get('site_id');
        if ($site_id){
            \Yii::$app->session['default_site_id'] = $site_id;
            return json_encode(['code'=>200,"msg"=>"切换成功"]);
        } else {
            return json_encode(['code'=>0,"msg"=>"切换失败"]);
        }
    }

    public function actionTest()
    {
        //var_dump($mname);
        //$q = Role::getList();
        //var_dump($q);
        /*foreach ($q as $k=>$v){
            var_dump($k);
            var_dump($v);
        }*/
        //$tt = Yii::$app->params['privilege_group'];
        //return json_encode($tt);
        /*$config = Yii::$app->redis->get('mykey');
        if (!$config){
            $config = 'hello';
            Yii::$app->redis->set('mykey', $config);
        }
        return $config;*/
    }
}
