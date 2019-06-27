<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property string $date
 * @property string $title
 * @property string $number
 * @property string $client
 * @property string $designer
 * @property string $general
 * @property string $exp
 * @property string $engineer
 * @property int $viewed
 * @property int $status
 * @property mixed projectExpert
 * @property mixed experts
 */
class Project extends \yii\db\ActiveRecord
{
    public $experts_array;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date'], 'date', 'format'=>'php:Y-m-d'],
            [['title', 'number', 'experts_array' ], 'required'],
            [['date'], 'default', 'value' => date('Y-m-d')],
            [['number'], 'match', 'pattern' => '/^[a-z,0-9, A-Z]\w*$/i', 'message' =>  'Використовуєте цифри та латинські літери'],
            [['designer', 'general'], 'string'],
            [['viewed', 'status'], 'integer'],
            [['title', 'number', 'client', 'engineer', 'exp'], 'string', 'max' => 255],
            [['experts_array'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'date' => Yii::t('app', 'Дата'),
            'title' => Yii::t('app', 'Назва проекту'),
            'number' => Yii::t('app', 'Справа №'),
            'client' => Yii::t('app', 'Замовник'),
            'designer' => Yii::t('app', 'Проектувальник'),
            'general' => Yii::t('app', 'Генеральний проектувальник'),
            'experts' => Yii::t('app', 'Експерти'),
            'experts_array' => Yii::t('app', 'Експерти'),
            'expertsAsString'  => Yii::t('app', 'Експерти'),
            'engineer' => Yii::t('app', 'Головний інженер'),
            'viewed' => Yii::t('app', 'Перегляди'),
            'status' => Yii::t('app', 'Статус'),
            'exp' => Yii::t('app', 'Стадія'),

        ];
    }
    public static function getStatusList(){
        return ['Новий проект', 'Проект в роботі', 'Відповіді відправлені', 'Зауваження зняті'];
    }
    public function getStatusName(){
        $list=self::getStatusList();
        return $list[$this->status];
    }
    public static function getStadList(){
        return ['РП', 'П', 'ТЕО', 'ТЕР', 'ЕП' ];
    }
    public function getStadName(){
        $list=self::getStadList();
        return $list[$this->exp];
    }
    public function getProjectExpert()
    {
        return $this->hasMany(ProjectExpert::class, ['project_id' => 'id']);
    }
    public function getExperts(){
        //return $this->hasMany(Expert::class, ['id'=>'expert_id'])->via('projectExpert');
        return $this->hasMany(Expert::class, ['id'=>'expert_id'])->via('projectExpert');
    }
    public function getExpertsAsString(){
        $arr = ArrayHelper::map($this->experts, 'id', 'name');
        return implode(', ', $arr);

    }
    public function afterFind(){
        $this->experts_array = $this->experts;
    }
    public function getsSelectedExperts(){
        $selectedExperts = $this->getExperts()->select('id')->asArray()->all();
        return ArrayHelper::getColumn($selectedExperts, 'id');
    }

public function saveExperts($experts){
        if(is_array($experts))
        {
            $this->clearExperts();
            foreach ($experts as $expert_id){
                $expert = Expert::findOne($expert_id);

                $model = new Status();
                $model->project_id= $this->id;
                $model->project= $this->title;
                $model->project_number=$this->number;
                $model->expert= $expert->name;
                $model->user_id= $expert_id;
                $model->status =0;
                $model->save();

                $expert->sendMailForExpert('forExpert', 'Очікуйте ПКД',
                ['paramExample' => $model->project_id, 'name'=> $expert->name]);


                $this->link('experts', $expert);
            }
        }
}
    public function clearExperts(){
        ProjectExpert::deleteAll(['project_id' => $this->id]);
        Status::deleteAll(['project_id' => $this->id]);

    }
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub

        $arr = ArrayHelper::map($this->experts, 'id', 'id');
       // $this->clearExperts();
       // ProjectExpert::deleteAll(['project_id' => $this->id]);
        foreach ($this->experts_array as $one){

            if(!in_array($one, $arr)){

                $model = new ProjectExpert();
                $model->project_id = $this->id;
                $model->expert_id = $one;

                $mod = new Status();
                $mod->project_id= $this->id;
                $mod->project= $this->title;
                $mod->project_number=$this->number;
                $expert = Expert::find()->where(['id' => $one])->one();

                $mod->expert= $expert->name;
                $mod->user_id= $one;
                $mod->status =0;

                $model->save();
                $mod->save();

                $expert->sendMailForExpert('forExpert', 'Очікуйте ПКД',
                    ['paramExample' => $model->project_id, 'name'=> $expert->name]);


            }
             //if(isset($arr[$one])){
           //   unset($arr[$one]);
         //   }
        }
       // ProjectExpert::deleteAll(['expert_id'=>$arr, 'project_id' => $this->id]);
       // Status::deleteAll(['user_id'=>$arr, 'project_id' => $this->id]);
    }



    public function getDate()
    {

        return Yii::$app->formatter->asDate($this->date,  $format = 'long');
    }
    public static function getPopular()
    {
        return Project::find()->where(['status' => 2])->orderBy('date desc')->all();
    }

    public static function getNew(){

        return Project::find()->where(['status' => 0])->orderBy('date desc')->all();
    }
    public function getComments(){
        return $this->hasMany(Comment::className(), ['project_id'=>'id']);
    }
    public function getProjectComments()
    {
        return $this->getComments()->all();//where(['status' => 0])->all();
    }
    public function viewedCount(){
        $this->viewed = 1;
        return $this->save(false);
    }
    public function getInforms(){
        return $this->hasMany(Inform::className(), ['project_id'=>'id']);
    }
    public function getProjectInforms()
    {
        return $this->getInforms()->all();//where(['status' => 0])->all();
    }
}
