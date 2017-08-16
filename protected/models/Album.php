<?php

/**
 * This is the model class for table "tbl_album".
 *
 * The followings are the available columns in table 'tbl_album':
 * @property integer $id
 * @property string $name
 * @property string $tags
 * @property integer $owner_id
 * @property integer $shareable
 * @property string $created_dt
 *
 * The followings are the available model relations:
 * @property User $owner
 * @property Photo[] $photos
 */
class Album extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_album';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('owner_id, shareable', 'numerical', 'integerOnly'=>true),
			array('name, tags', 'length', 'max'=>255),
                        array('description','length', 'max'=>1024),
                        array('description', 'match', 'pattern'=>'/[\w]+/u'), // \-\_\'\ \,\p{L}0-9
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, tags, owner_id, shareable, created_dt', 'safe', 'on'=>'search'),
		);
	}
        protected function beforeSave()
	{
          
            if(parent::beforeSave()) {
                if($this->isNewRecord) {
                    $this->created_dt= new CDbExpression("NOW()");
                    //$this->owner_id=Yii::app()->user->id;
                }
                return true;
            }
            else{
                return false;	
             }
        
            }
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'owner' => array(self::BELONGS_TO, 'User', 'owner_id'),
			'photos' => array(self::HAS_MANY, 'Photo', 'album_id'),
		);
                
	}
         public function scopes()
        {
                return array(
                    'shareable'=>array(
                        'order'=>'created_dt DESC',
                        'condition'=>'shareable=1',
                        )
                );
        }       
                //$album=Album::$model()->shareable()->findAll();
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'tags' => 'Tags',
			'owner_id' => 'Owner',
                        'category_id' => 'Catgeory',
                        'description' => 'Description',
                        'shareable' => 'Shareable',
			'created_dt' => 'Created Dt',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		
		$criteria->compare('name',$this->name,true);
		$criteria->compare('tags',$this->tags,true);
                 $criteria->compare('description',$this->description);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Album the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
