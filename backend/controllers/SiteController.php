<?php
namespace backend\controllers;

use Yii;
use yii\db\Query;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use rbac\models\form\Login;

class SiteController extends Controller
{
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
                        'actions' => ['logout', 'index', 'test', 'clear', 'change', 'dump'],
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

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionGrid()
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
        return $this->render('grid', ["data"=>['x'=>$x,'y'=>$y,'x1'=>$x1,'y1'=>$y1]]);
    }

    public function actionIndex()
    {
        $site_id = \Yii::$app->session['default_site_id'];
        $query1 = new Query();
        $rows1 = $query1->select(['ip', 'access_date', 'COUNT(*) as num'])
            ->from('t_trace')
            ->where(['site_id'=>$site_id,'access_date'=>date("Y-m-d")])
            ->groupBy('ip')
            ->all();
        $x1 = [];
        $y1 = [];
        foreach ($rows1 as $value) {
            $x1[] = $value['ip'];
            $y1[] = $value['num'];
        }
        $query2 = new Query();
        $rows = $query2->select(['access_date', 'COUNT(*) as num'])
            ->from('t_trace')
            ->where(['site_id'=>$site_id])
            ->orderBy('access_date desc')
            ->groupBy('access_date')
            ->limit(15)
            ->all();
        $x = [];
        $y = [];
        foreach ($rows as $value) {
            $x[] = $value['access_date'];
            $y[] = $value['num'];
        }
        return $this->render('index', ["data"=>['x'=>$x,'y'=>$y,'x1'=>$x1,'y1'=>$y1]]);
    }

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
        $site_id = Yii::$app->request->get('site_id');
        if ($site_id){
            \Yii::$app->session['default_site_id'] = $site_id;
            return json_encode(['code'=>200,"msg"=>"切换成功"]);
        } else {
            return json_encode(['code'=>0,"msg"=>"切换失败"]);
        }
    }

    public function actionDump()
    {
        $table = Yii::$app->request->get('table'); // 表名
        $id_name = Yii::$app->request->get('id_name'); // 表主键id名
        $id_value = Yii::$app->request->get('id_value'); // 表主键id值
        $field  = Yii::$app->request->get('field'); // 修改哪个字段
        $value  = Yii::$app->request->get('value'); // 修改字段值
        $data = Yii::$app->db->createCommand()->update("{{%$table}}", [
            $field => $value
        ], "$id_name=:$id_name", [$id_name => $id_value])->execute();
        if ($data !== false) {
            return json_encode(['code'=>200,"msg"=>"操作成功"]);
        } else {
            return json_encode(['code'=>0,"msg"=>"操作失败"]);
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
