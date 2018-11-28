<?php

namespace backend\controllers;

use Yii;
use common\models\Rigs;
use common\models\search\RigsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RigsController implements the CRUD actions for Rigs model.
 */
class RigsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'mutual' => ['POST'],
                    'info' => ['POST'],
                    'post' => ['POST'],
                ],
            ],
        ];
    }

    // public function beforeAction($action) {
    //     $this->enableCsrfValidation = false;
    //     return parent::beforeAction($action);
    // }

    public function actionMutual()
    {
        if ($post = Yii::$app->request->post()) {
            if ($post['type'] == 'json') {
                $data = Rigs::mutualData();
                return json_encode($data);
            }
        }
    }

    /**
     * Lists all Rigs models.
     * @return mixed
     */
    public function actionIndex(int $id = 1)
    {
        $searchModel = new RigsSearch();

        $cache = Yii::$app->cache->get('rigsLastData');

        if ($cache) {
            $dataProvider = $cache;
        } else {
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            Yii::$app->cache->set('rigsLastData', $dataProvider, 600);
        }


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'modelFirst' => $this->findModel($id),
        ]);
    }

    /**
     * Displays a single Rigs model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Rigs model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Rigs();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Rigs model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Rigs model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete(int $id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }



    public function actionRaw(int $id)
    {
        session_write_close();
        $this->layout = false;
        $model = $this->findModel($id);
        // $data = file_get_contents('http://127.0.0.1:8109');
        // $data = shell_exec('curl --max-time 10 http://127.0.0.1:8109 2>&1');
        $data = shell_exec('curl --max-time 5 ' . $model['ip'] . ':3333 2>&1');
        // exec('cat /opt/raw-rig.sh ' . $id, $data);

        if (($post = Yii::$app->request->post()) && $post['type'] === 'json') {
            return json_encode($data);
        }

        return $this->render('raw', [
            'model' => $this->findModel($id),
            'raw' => $data,
        ]);
    }


    public function actionInfo(int $id = 1)
    {
        if (($post = Yii::$app->request->post()) && $post['id']) {
            if (($model = Rigs::findOne($post['id'])) !== null) {
                $data = [
                    'id' => $model->id,
                    'ip' => $model->ip,
                    'dayRate' => $model->dayRate,
                    'hostname' => $model->hostname,
                ];

                if ($model->lastJournal) {
                    $data['state'] = $model->lastJournal->up;
                    $data['temps'] = $model->lastJournal->tempData;
                    $data['rate'] = $model->lastJournal->totalHashrate;
                    $data['count'] = count(explode(";", $model->lastJournal->rate_details));
                    $data['runtime'] = 'Runtime: ' . (int)($model->lastJournal->runtime / 60) . ' h ' . ($model->lastJournal->runtime % 60) . ' min';
                }
                return json_encode($data, true);
            }
        }

        throw new NotFoundHttpException('The requested model does not exist.');
    }





    /**
     * Finds the Rigs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Rigs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rigs::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }



}
