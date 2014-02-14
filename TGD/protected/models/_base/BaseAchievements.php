<?php

/**
 * This is the model base class for the table "{{achievements}}".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Achievements".
 *
 * Columns in table "{{achievements}}" available as properties of the model,
 * followed by relations of table "{{achievements}}" available as properties of the model.
 *
 * @property string $id
 * @property integer $achievement_type_id
 * @property string $title_en_us
 * @property string $title_es
 * @property string $link_en_us
 * @property string $link_es
 * @property string $text_en_us
 * @property string $text_es
 * @property string $achievements_start
 * @property string $achievements_finish
 * @property string $created_at
 * @property string $updated_at
 *
 * @property AchievementsTypes $achievementType
 */
abstract class BaseAchievements extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{achievements}}';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Announcement|Announcements', $n);
	}

	public static function representingColumn() {
		return 'id';
	}

	public function rules() {
		return array(
			array('id', 'required'),
			array('achievement_type_id', 'numerical', 'integerOnly'=>true),
			array('id, title_en_us, title_es, link_en_us, link_es', 'length', 'max'=>255),
			array('text_en_us, text_es, achievements_start, achievements_finish, created_at, updated_at', 'safe'),
			array('achievement_type_id, title_en_us, title_es, link_en_us, link_es, text_en_us, text_es, achievements_start, achievements_finish, created_at, updated_at', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, achievement_type_id, title_en_us, title_es, link_en_us, link_es, text_en_us, text_es, achievements_start, achievements_finish, created_at, updated_at', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'achievementType' => array(self::BELONGS_TO, 'AchievementsTypes', 'achievement_type_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'achievement_type_id' => null,
			'title_en_us' => Yii::t('app', 'Title En Us'),
			'title_es' => Yii::t('app', 'Title Es'),
			'link_en_us' => Yii::t('app', 'Link En Us'),
			'link_es' => Yii::t('app', 'Link Es'),
			'text_en_us' => Yii::t('app', 'Text En Us'),
			'text_es' => Yii::t('app', 'Text Es'),
			'achievements_start' => Yii::t('app', 'Achievement Start'),
			'achievements_finish' => Yii::t('app', 'Achievement Finish'),
			'created_at' => Yii::t('app', 'Created At'),
			'updated_at' => Yii::t('app', 'Updated At'),
			'achievementType' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id, true);
		$criteria->compare('achievement_type_id', $this->achievement_type_id);
		$criteria->compare('title_en_us', $this->title_en_us, true);
		$criteria->compare('title_es', $this->title_es, true);
		$criteria->compare('link_en_us', $this->link_en_us, true);
		$criteria->compare('link_es', $this->link_es, true);
		$criteria->compare('text_en_us', $this->text_en_us, true);
		$criteria->compare('text_es', $this->text_es, true);
		$criteria->compare('achievements_start', $this->achievements_start, true);
		$criteria->compare('achievements_finish', $this->achievements_finish, true);
		$criteria->compare('created_at', $this->created_at, true);
		$criteria->compare('updated_at', $this->updated_at, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}