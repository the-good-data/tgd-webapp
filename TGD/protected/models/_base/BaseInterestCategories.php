<?php

/**
 * This is the model base class for the table "{{interest_categories}}".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "InterestCategories".
 *
 * Columns in table "{{interest_categories}}" available as properties of the model,
 * followed by relations of table "{{interest_categories}}" available as properties of the model.
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $category
 *
 */
abstract class BaseInterestCategories extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{interest_categories}}';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'InterestCategories|InterestCategories', $n);
	}

	public static function representingColumn() {
		return 'site';
	}

	public function rules() {
		return array(
			array('parent_id', 'numerical', 'integerOnly'=>true),
			array('parent_id, category, status', 'safe'),
			array('id, parent_id, category', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array();
	}

	public function pivotModels() {
		return array();
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'parent_id' => Yii::t('app', 'Parent'),
			'category' => Yii::t('app', 'Category'),

		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('parent_id', $this->parent_id);
		$criteria->compare('LOWER(category)', strtolower($this->category), true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort'=>array(
                'defaultOrder'=>'id',
            ),
            'pagination'=>array(
                'pageSize'=>20
            )
        ));
	}
}