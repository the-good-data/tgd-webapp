<?php

/**
 * This is the model base class for the table "{{browsing}}".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Browsing".
 *
 * Columns in table "{{browsing}}" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $id
 * @property integer $member_id
 * @property string $user_id
 * @property string $domain
 * @property string $url
 * @property string $usertime
 * @property string $created_at
 * @property string $updated_at
 *
 */
abstract class BaseBrowsing extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{browsing}}';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Browsing|Browsings', $n);
	}

	public static function representingColumn() {
		return 'domain';
	}

	public function rules() {
		return array(
			array('member_id', 'numerical', 'integerOnly'=>true),
			array('user_id, domain', 'length', 'max'=>255),
			array('url, usertime, created_at, updated_at', 'safe'),
			array('member_id, user_id, domain, url, usertime, created_at, updated_at', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, member_id, user_id, domain, url, usertime, created_at, updated_at', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'member_id' => Yii::t('app', 'Member'),
			'user_id' => Yii::t('app', 'User'),
			'domain' => Yii::t('app', 'Domain'),
			'url' => Yii::t('app', 'Url'),
			'usertime' => Yii::t('app', 'Usertime'),
			'created_at' => Yii::t('app', 'Created At'),
			'updated_at' => Yii::t('app', 'Updated At'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('member_id', $this->member_id);
		$criteria->compare('user_id', $this->user_id, true);
		$criteria->compare('domain', $this->domain, true);
		$criteria->compare('url', $this->url, true);
		$criteria->compare('usertime', $this->usertime, true);
		$criteria->compare('created_at', $this->created_at, true);
		$criteria->compare('updated_at', $this->updated_at, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}