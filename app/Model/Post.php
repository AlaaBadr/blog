<?php
App::uses('AppModel', 'Model');
/**
 * Post Model
 *
 * @property User $User
 * @property Comment $Comment
 */
class Post extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';

/**
 * Display field
 *
 * @var string
 */
    public $validate = array(
        'id' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            ),
        ),
        'user_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            )
        ),
        'title' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            ),
        ),
        'body' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            ),
        ),
    );


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Comment' => array(
			'className' => 'Comment',
			'foreignKey' => 'post_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
