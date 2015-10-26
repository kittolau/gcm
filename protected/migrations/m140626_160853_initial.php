<?php

class m140626_160853_initial extends CDbMigration
{
	public function up()
	{
		    $this->createTable('comments', array(
        'id'=>'pk',
        'message'=>'text DEFAULT NULL',
        'userId'=>'int(11) unsigned DEFAULT NULL',
        'createDate'=>'datetime DEFAULT NULL',
    ), '');

    $this->createTable('event', array(
        'id'=>'pk',
        'title'=>'varchar(50) NOT NULL',
        'event_date'=>'date NOT NULL',
        'event_time_interval'=>'varchar(50) NOT NULL',
        'apply_date'=>'varchar(50) NOT NULL',
        'place_rent'=>'varchar(100) NOT NULL',
        'lat_lng'=>'varchar(50) NOT NULL',
        'event_place_title'=>'varchar(50) NOT NULL',
        'ticket_price'=>'varchar(50) NOT NULL',
        'icon_thumbnail_src'=>'varchar(3200) NOT NULL',
        'icon_src'=>'varchar(3200) NOT NULL',
        'is_promotion_iframe_allowed'=>'bit(1) NOT NULL',
        'is_product_upload_allowed'=>'bit(1) NOT NULL',
        'is_doujin'=>'bit(1) NOT NULL',
        'is_cosplay'=>'bit(1) NOT NULL',
        'is_stage'=>'bit(1) NOT NULL',
        'official_website_url'=>'varchar(500) NOT NULL',
        'apply_form_url'=>'varchar(500) NOT NULL',
    ), '');

    $this->createTable('group', array(
        'id'=>'pk',
        'approved'=>'tinyint(1) NOT NULL',
        'group_name'=>'varchar(50) NOT NULL',
        'group_summary'=>'varchar(150) NOT NULL',
        'created_datetime'=>'datetime NOT NULL',
        'popularity'=>'int(11) NOT NULL',
        'is_recuiting'=>'tinyint(1) NOT NULL',
        'website_url'=>'varchar(100) NOT NULL',
        'contact_email'=>'varchar(100) NOT NULL',
        'facebook_url'=>'varchar(100) NOT NULL',
        'is_auto_approved'=>'tinyint(1) NOT NULL',
        'icon_src'=>'varchar(100) NOT NULL',
        'apply_img'=>'varchar(100) NOT NULL',
    ), '');

    $this->createTable('group_product', array(
        'id'=>'pk',
        'group_id'=>'int(11) NOT NULL',
        'price'=>"double NOT NULL DEFAULT '0'",
        'created_datetime'=>'datetime NOT NULL',
        'last_update_datetime'=>'timestamp NOT NULL',
        'img_src'=>'varchar(3200) NOT NULL',
        'thumbnail_src'=>'varchar(3200) DEFAULT NULL',
        'product_summary'=>'varchar(300) DEFAULT NULL',
        'tag'=>'varchar(600) DEFAULT NULL',
        'is_r18'=>'tinyint(1) DEFAULT NULL',
        'is_bl'=>'tinyint(1) DEFAULT NULL',
        'is_deleted'=>'tinyint(1) DEFAULT NULL',
        'product_catagory_enum'=>'int(11) DEFAULT NULL',
        'book_number_of_page'=>'int(11) DEFAULT NULL',
        'book_inner_page_materia'=>'varchar(30) DEFAULT NULL',
        'book_outer_page_materia'=>'varchar(30) DEFAULT NULL',
        'gift_material'=>'varchar(30) DEFAULT NULL',
        'elect_demo_url'=>'varchar(100) DEFAULT NULL',
        'elect_is_selling'=>'tinyint(1) DEFAULT NULL',
        'elect_selling_url'=>'varchar(100) DEFAULT NULL',
        'elect_size'=>'int(11) DEFAULT NULL',
        'elect_format'=>'varchar(20) DEFAULT NULL',
        'title'=>'varchar(50) NOT NULL',
        'popularity'=>'int(11) NOT NULL',
        'non_user_popularity'=>'int(11) NOT NULL',
    ), '');

    $this->createIndex('idx_group_id', 'group_product', 'group_id', FALSE);

    $this->createTable('group_product_join_event', array(
        'product_id'=>'int(11) NOT NULL',
        'event_id'=>'int(11) NOT NULL',
    ), '');

    $this->createIndex('idx_event_id', 'group_product_join_event', 'event_id', FALSE);

    $this->createIndex('idx_product_id', 'group_product_join_event', 'product_id', FALSE);

    $this->addPrimaryKey('pk_group_product_join_event', 'group_product_join_event', 'product_id,event_id');

    $this->createTable('group_tag_frequency', array(
        'id'=>'pk',
        'tag'=>'varchar(50) NOT NULL',
        'frequency'=>'int(11) NOT NULL',
    ), '');

    $this->createTable('groupproduct_posts_comments_nm', array(
        'postId'=>'int(11) unsigned NOT NULL',
        'commentId'=>'int(11) unsigned NOT NULL',
    ), '');

    $this->addPrimaryKey('pk_groupproduct_posts_comments_nm', 'groupproduct_posts_comments_nm', 'postId,commentId');

    $this->createTable('illust', array(
        'id'=>'pk',
        'created_datetime'=>'datetime NOT NULL',
        'update_datetime'=>'datetime NOT NULL',
        'popularity'=>'int(11) NOT NULL',
        'illust_summary'=>'varchar(300) NOT NULL',
        'tag'=>'varchar(600) NOT NULL',
        'img_src'=>'varchar(3200) NOT NULL',
        'is_r18'=>'tinyint(1) NOT NULL',
        'is_bl'=>'tinyint(1) NOT NULL',
        'is_deleted'=>'tinyint(1) NOT NULL',
        'illust_category_enum'=>'int(11) NOT NULL',
        'illust_title'=>'varchar(25) NOT NULL',
        'non_user_popularity'=>'int(11) NOT NULL',
        'img_thumbnail_src'=>'varchar(3200) NOT NULL',
    ), '');

    $this->createTable('illust_category', array(
        'id'=>'pk',
        'category_title'=>'varchar(30) NOT NULL',
    ), '');

    $this->createTable('illust_tag_frequency', array(
        'id'=>'pk',
        'tag'=>'varchar(50) NOT NULL',
        'frequency'=>'int(11) NOT NULL',
    ), '');

    $this->createTable('posts_comments_nm', array(
        'postId'=>'int(11) unsigned NOT NULL',
        'commentId'=>'int(11) unsigned NOT NULL',
    ), '');

    $this->addPrimaryKey('pk_posts_comments_nm', 'posts_comments_nm', 'postId,commentId');

    $this->createTable('product_catagory', array(
        'id'=>'pk',
        'catagory_title'=>'varchar(50) NOT NULL',
    ), '');

    $this->createTable('update_log', array(
        'text'=>'longtext DEFAULT NULL',
    ), '');

    $this->createTable('user', array(
        'id'=>'pk',
        'sex'=>'varchar(2) NOT NULL',
        'website_url'=>'varchar(100) NOT NULL',
        'summary'=>'varchar(300) NOT NULL',
        'user_name'=>'varchar(20) NOT NULL',
        'email'=>'varchar(100) NOT NULL',
        'password'=>'varchar(64) NOT NULL',
        'created_datetime'=>'datetime NOT NULL',
        'icon_src'=>'varchar(300) NOT NULL',
        'show_r18'=>'tinyint(1) NOT NULL',
        'show_bl'=>'tinyint(1) NOT NULL',
        'accept_job'=>'tinyint(1) NOT NULL',
        'birthday'=>'date NOT NULL',
        'is_admin'=>'tinyint(1) NOT NULL',
        'nickname'=>'varchar(15) DEFAULT NULL',
    ), '');

    $this->createTable('user_bookmark_illust', array(
        'user_id'=>'int(11) NOT NULL',
        'illust_id'=>'int(11) NOT NULL',
    ), '');

    $this->createIndex('idx_illust_id', 'user_bookmark_illust', 'illust_id', FALSE);

    $this->createIndex('idx_user_id', 'user_bookmark_illust', 'user_id', FALSE);

    $this->addPrimaryKey('pk_user_bookmark_illust', 'user_bookmark_illust', 'user_id,illust_id');

    $this->createTable('user_follow_group', array(
        'user_id'=>'int(11) NOT NULL',
        'group_id'=>'int(11) NOT NULL',
    ), '');

    $this->createIndex('idx_user_id', 'user_follow_group', 'user_id', FALSE);

    $this->createIndex('idx_group_id', 'user_follow_group', 'group_id', FALSE);

    $this->addPrimaryKey('pk_user_follow_group', 'user_follow_group', 'user_id,group_id');

    $this->createTable('user_follow_user', array(
        'user_id'=>'int(11) NOT NULL',
        'follow_user_id'=>'int(11) NOT NULL',
    ), '');

    $this->createIndex('idx_follow_user_id', 'user_follow_user', 'follow_user_id', FALSE);

    $this->createIndex('idx_user_id', 'user_follow_user', 'user_id', FALSE);

    $this->addPrimaryKey('pk_user_follow_user', 'user_follow_user', 'user_id,follow_user_id');

    $this->createTable('user_member_group', array(
        'user_id'=>'int(11) NOT NULL',
        'group_id'=>'int(11) NOT NULL',
        'joinded_datetime'=>'datetime NOT NULL',
        'is_leader'=>'tinyint(1) NOT NULL',
        'is_approved'=>'tinyint(1) NOT NULL',
    ), '');

    $this->createIndex('idx_group_id', 'user_member_group', 'group_id', FALSE);

    $this->createIndex('idx_user_id', 'user_member_group', 'user_id', FALSE);

    $this->addPrimaryKey('pk_user_member_group', 'user_member_group', 'user_id,group_id');

    $this->createTable('user_mq', array(
        'user_id'=>'int(11) NOT NULL',
        'msg'=>'varchar(100) NOT NULL',
    ), '');

    $this->createTable('user_own_illust', array(
        'user_id'=>'int(11) NOT NULL',
        'illust_id'=>'int(11) NOT NULL',
    ), '');

    $this->createIndex('idx_illust_id', 'user_own_illust', 'illust_id', FALSE);

    $this->createIndex('idx_user_id', 'user_own_illust', 'user_id', FALSE);

    $this->addPrimaryKey('pk_user_own_illust', 'user_own_illust', 'user_id,illust_id');

    $this->createTable('user_subscription', array(
        'user_id'=>'int(11) NOT NULL',
        'notifi_enum'=>'int(11) NOT NULL',
        'scription_target_id'=>'int(11) NOT NULL',
    ), '');

    $this->createTable('user_viewed_group_product', array(
        'user_id'=>'int(11) NOT NULL',
        'group_product_id'=>'int(11) NOT NULL',
        'count'=>'int(11) NOT NULL',
        'url_referrer'=>'varchar(200) NOT NULL',
        'view_datetime'=>'datetime NOT NULL',
    ), '');

    $this->createIndex('idx_group_product_id', 'user_viewed_group_product', 'group_product_id', FALSE);

    $this->createIndex('idx_user_id', 'user_viewed_group_product', 'user_id', FALSE);

    $this->addPrimaryKey('pk_user_viewed_group_product', 'user_viewed_group_product', 'user_id,group_product_id');

    $this->createTable('user_viewed_illust', array(
        'user_id'=>'int(11) NOT NULL',
        'illust_id'=>'int(11) NOT NULL',
        'count'=>'int(11) NOT NULL',
        'url_referrer'=>'varchar(200) NOT NULL',
        'view_datetime'=>'datetime NOT NULL',
    ), '');

    $this->createIndex('idx_user_id', 'user_viewed_illust', 'user_id', FALSE);

    $this->createIndex('idx_illust_id', 'user_viewed_illust', 'illust_id', FALSE);

    $this->addPrimaryKey('pk_user_viewed_illust', 'user_viewed_illust', 'user_id,illust_id');

    $this->addForeignKey('fk_group_product_group_group_id', 'group_product', 'group_id', 'group', 'id', 'NO ACTION', 'NO ACTION');

    $this->addForeignKey('fk_group_product_join_event_event_event_id', 'group_product_join_event', 'event_id', 'event', 'id', 'NO ACTION', 'NO ACTION');

    $this->addForeignKey('fk_group_product_join_event_group_product_product_id', 'group_product_join_event', 'product_id', 'group_product', 'id', 'NO ACTION', 'NO ACTION');

    $this->addForeignKey('fk_user_bookmark_illust_illust_illust_id', 'user_bookmark_illust', 'illust_id', 'illust', 'id', 'NO ACTION', 'NO ACTION');

    $this->addForeignKey('fk_user_bookmark_illust_user_user_id', 'user_bookmark_illust', 'user_id', 'user', 'id', 'NO ACTION', 'NO ACTION');

    $this->addForeignKey('fk_user_follow_group_user_user_id', 'user_follow_group', 'user_id', 'user', 'id', 'NO ACTION', 'NO ACTION');

    $this->addForeignKey('fk_user_follow_group_group_group_id', 'user_follow_group', 'group_id', 'group', 'id', 'NO ACTION', 'NO ACTION');

    $this->addForeignKey('fk_user_follow_user_user_follow_user_id', 'user_follow_user', 'follow_user_id', 'user', 'id', 'NO ACTION', 'NO ACTION');

    $this->addForeignKey('fk_user_follow_user_user_user_id', 'user_follow_user', 'user_id', 'user', 'id', 'NO ACTION', 'NO ACTION');

    $this->addForeignKey('fk_user_member_group_group_group_id', 'user_member_group', 'group_id', 'group', 'id', 'NO ACTION', 'NO ACTION');

    $this->addForeignKey('fk_user_member_group_user_user_id', 'user_member_group', 'user_id', 'user', 'id', 'NO ACTION', 'NO ACTION');

    $this->addForeignKey('fk_user_own_illust_illust_illust_id', 'user_own_illust', 'illust_id', 'illust', 'id', 'NO ACTION', 'NO ACTION');

    $this->addForeignKey('fk_user_own_illust_user_user_id', 'user_own_illust', 'user_id', 'user', 'id', 'NO ACTION', 'NO ACTION');

    $this->addForeignKey('fk_user_viewed_group_product_group_product_group_product_id', 'user_viewed_group_product', 'group_product_id', 'group_product', 'id', 'NO ACTION', 'NO ACTION');

    $this->addForeignKey('fk_user_viewed_group_product_user_user_id', 'user_viewed_group_product', 'user_id', 'user', 'id', 'NO ACTION', 'NO ACTION');

    $this->addForeignKey('fk_user_viewed_illust_user_user_id', 'user_viewed_illust', 'user_id', 'user', 'id', 'NO ACTION', 'NO ACTION');

    $this->addForeignKey('fk_user_viewed_illust_illust_illust_id', 'user_viewed_illust', 'illust_id', 'illust', 'id', 'NO ACTION', 'NO ACTION');
	}

	public function down()
	{
		$this->dropForeignKey('fk_group_product_group_group_id', 'group_product');

    $this->dropForeignKey('fk_group_product_join_event_event_event_id', 'group_product_join_event');

    $this->dropForeignKey('fk_group_product_join_event_group_product_product_id', 'group_product_join_event');

    $this->dropForeignKey('fk_user_bookmark_illust_illust_illust_id', 'user_bookmark_illust');

    $this->dropForeignKey('fk_user_bookmark_illust_user_user_id', 'user_bookmark_illust');

    $this->dropForeignKey('fk_user_follow_group_user_user_id', 'user_follow_group');

    $this->dropForeignKey('fk_user_follow_group_group_group_id', 'user_follow_group');

    $this->dropForeignKey('fk_user_follow_user_user_follow_user_id', 'user_follow_user');

    $this->dropForeignKey('fk_user_follow_user_user_user_id', 'user_follow_user');

    $this->dropForeignKey('fk_user_member_group_group_group_id', 'user_member_group');

    $this->dropForeignKey('fk_user_member_group_user_user_id', 'user_member_group');

    $this->dropForeignKey('fk_user_own_illust_illust_illust_id', 'user_own_illust');

    $this->dropForeignKey('fk_user_own_illust_user_user_id', 'user_own_illust');

    $this->dropForeignKey('fk_user_viewed_group_product_group_product_group_product_id', 'user_viewed_group_product');

    $this->dropForeignKey('fk_user_viewed_group_product_user_user_id', 'user_viewed_group_product');

    $this->dropForeignKey('fk_user_viewed_illust_user_user_id', 'user_viewed_illust');

    $this->dropForeignKey('fk_user_viewed_illust_illust_illust_id', 'user_viewed_illust');

    $this->dropTable('comments');
    $this->dropTable('event');
    $this->dropTable('group');
    $this->dropTable('group_product');
    $this->dropTable('group_product_join_event');
    $this->dropTable('group_tag_frequency');
    $this->dropTable('groupproduct_posts_comments_nm');
    $this->dropTable('illust');
    $this->dropTable('illust_category');
    $this->dropTable('illust_tag_frequency');
    $this->dropTable('posts_comments_nm');
    $this->dropTable('product_catagory');
    $this->dropTable('update_log');
    $this->dropTable('user');
    $this->dropTable('user_bookmark_illust');
    $this->dropTable('user_follow_group');
    $this->dropTable('user_follow_user');
    $this->dropTable('user_member_group');
    $this->dropTable('user_mq');
    $this->dropTable('user_own_illust');
    $this->dropTable('user_subscription');
    $this->dropTable('user_viewed_group_product');
    $this->dropTable('user_viewed_illust');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}