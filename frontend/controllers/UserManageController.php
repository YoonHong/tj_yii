<?php

namespace frontend\controllers;

use Yii;
use common\models\UserInfo;
use frontend\models\SignupForm;
use frontend\models\UserManage;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


use common\models\User;
/**
 * UserManageController implements the CRUD actions for UserInfo model.
 */
class UserManageController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all UserInfo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserManage();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserInfo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new UserInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserInfo();
        $user_model =  new SignupForm();
        $user_model->scenario = SignupForm::SCENARIO_CREATE;

        if ($model->load(Yii::$app->request->post())
              && $user_model->load(Yii::$app->request->post())
              && $model->validate()
              && $user_model->validate()
        ) {

          $dbTrans = Yii::$app->db->beginTransaction();

          $user = $user_model->saveUser();
          if ($user) {
              $model->id = $user->id;

              if ($model->save()) {
                  $dbTrans->commit();
                  Yii::$app->getSession()->setFlash('success', $user->username.' has been successfully created!');

                  return $this->redirect(['index']);
              }

          }

          $dbTrans->rollback();
          Yii::$app->getSession()->setFlash('error', 'Create User has failed!!!');
          return $this->redirect(['index']);

        } else {
            return $this->render('create', [
                'model' => $model,
                'user_model' => $user_model,
            ]);
        }

    }
    /**
     * Updates an existing UserInfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $user_model =  new SignupForm();
        $user_model->scenario = SignupForm::SCENARIO_UPDATE;

        $user =  User::findOne($id);
        $user_model->email = $user->email;
        $user_model->id = $id;

        if ($model->load(Yii::$app->request->post())
             && $user_model->load(Yii::$app->request->post())
             && $model->validate()
             && $user_model->validate()
        ) {
            $dbTrans = Yii::$app->db->beginTransaction();

            if ($model->save() && $user_model->updateUser($user)) {
                $dbTrans->commit();
                Yii::$app->getSession()->setFlash('success', $user->username.' has been successfully updated!');

                return $this->redirect(['index']);
            }

            $dbTrans->rollback();
            Yii::$app->getSession()->setFlash('error', 'Update User has failed!!!');
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'user_model' => $user_model,
            ]);
        }
    }

    /**
     * Deletes an existing UserInfo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserInfo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
