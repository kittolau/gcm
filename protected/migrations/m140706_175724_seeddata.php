
<?php

/**
 * Created with https://github.com/schmunk42/database-command
 */

class m140706_175724_seeddata extends CDbMigration {

	public function safeUp() {
        if ($this->dbConnection->schema instanceof CMysqlSchema) {
           $this->execute('SET FOREIGN_KEY_CHECKS = 0;');
           $options = 'ENGINE=InnoDB DEFAULT CHARSET=utf8';
        } else {
           $options = '';
        }
        $this->truncateTable("comments");
        $this->truncateTable("event");
        $this->truncateTable("group");
        $this->truncateTable("group_product");
        $this->truncateTable("group_product_join_event");
        $this->truncateTable("group_tag_frequency");
        $this->truncateTable("groupproduct_posts_comments_nm");
        $this->truncateTable("illust");
        $this->truncateTable("illust_category");
        $this->truncateTable("illust_tag_frequency");
        $this->truncateTable("posts_comments_nm");
        $this->truncateTable("product_catagory");
        $this->truncateTable("tbl_migration");
        $this->truncateTable("update_log");
        $this->truncateTable("user");
        $this->truncateTable("user_bookmark_illust");
        $this->truncateTable("user_follow_group");
        $this->truncateTable("user_follow_user");
        $this->truncateTable("user_member_group");
        $this->truncateTable("user_mq");
        $this->truncateTable("user_own_illust");
        $this->truncateTable("user_subscription");
        $this->truncateTable("user_viewed_group_product");
        $this->truncateTable("user_viewed_illust");







        // Data for table 'comments'
        $this->insert("comments", array(
            "id"=>"1",
            "message"=>"aaaaaa",
            "userId"=>"24",
            "createDate"=>"2014-02-26 20:27:53",
        ) );

        $this->insert("comments", array(
            "id"=>"2",
            "message"=>"aaaaaa",
            "userId"=>"24",
            "createDate"=>"2014-02-26 20:27:55",
        ) );

        $this->insert("comments", array(
            "id"=>"5",
            "message"=>"awf",
            "userId"=>"40",
            "createDate"=>"2014-03-31 22:00:25",
        ) );

        $this->insert("comments", array(
            "id"=>"6",
            "message"=>"awf",
            "userId"=>"42",
            "createDate"=>"2014-05-04 23:48:31",
        ) );

        $this->insert("comments", array(
            "id"=>"7",
            "message"=>"awfwa",
            "userId"=>"42",
            "createDate"=>"2014-05-04 23:51:23",
        ) );

        $this->insert("comments", array(
            "id"=>"8",
            "message"=>"awfawf",
            "userId"=>"42",
            "createDate"=>"2014-05-04 23:59:25",
        ) );




        // Data for table 'event'
        $this->insert("event", array(
            "id"=>"38",
            "title"=>"Pass Event",
            "event_date"=>"2012-03-24",
            "event_time_interval"=>"1
2
3
",
            "apply_date"=>"1
2
3
",
            "place_rent"=>"1
2
3
",
            "lat_lng"=>"-34.397, 150.644",
            "event_place_title"=>"1
2
3
4
",
            "ticket_price"=>"1
2
3
",
            "icon_thumbnail_src"=>"img/Event/38/ficon_1.jpg",
            "icon_src"=>"img/Event/38/icon_1.png",
            "is_promotion_iframe_allowed"=>"1",
            "is_product_upload_allowed"=>"1",
            "is_doujin"=>"1",
            "is_cosplay"=>"0",
            "is_stage"=>"1",
            "official_website_url"=>"http://www.google.com",
            "apply_form_url"=>"http://www.google.com",
        ) );

        $this->insert("event", array(
            "id"=>"39",
            "title"=>"Future Event",
            "event_date"=>"2018-03-24",
            "event_time_interval"=>"1
2
3
4",
            "apply_date"=>"1
2
3",
            "place_rent"=>"1
2
3
",
            "lat_lng"=>"-34.397, 150.644",
            "event_place_title"=>"1
2
3
4",
            "ticket_price"=>"1
2
3
",
            "icon_thumbnail_src"=>"img/Event/default.jpg",
            "icon_src"=>"img/Event/default.jpg",
            "is_promotion_iframe_allowed"=>"1",
            "is_product_upload_allowed"=>"1",
            "is_doujin"=>"1",
            "is_cosplay"=>"1",
            "is_stage"=>"0",
            "official_website_url"=>"http://www.google.com",
            "apply_form_url"=>"http://www.google.com",
        ) );




        // Data for table 'group'
        $this->insert("group", array(
            "id"=>"7",
            "approved"=>"1",
            "group_name"=>"adminadmin's group",
            "group_summary"=>"",
            "created_datetime"=>"2014-07-06 17:43:21",
            "popularity"=>"0",
            "is_recuiting"=>"0",
            "website_url"=>"",
            "contact_email"=>"group@group.com",
            "facebook_url"=>"",
            "is_auto_approved"=>"0",
            "icon_src"=>"img/Group/circle.png",
            "apply_img"=>"img/Group/adminadmin's group/6332a8fa3a3ca5dd8320fdf0c335101b_1.png",
        ) );

        $this->insert("group", array(
            "id"=>"8",
            "approved"=>"0",
            "group_name"=>"adminadmin's group noshow",
            "group_summary"=>"",
            "created_datetime"=>"2014-07-06 17:44:31",
            "popularity"=>"0",
            "is_recuiting"=>"0",
            "website_url"=>"",
            "contact_email"=>"www@www.com",
            "facebook_url"=>"",
            "is_auto_approved"=>"0",
            "icon_src"=>"",
            "apply_img"=>"",
        ) );

        $this->insert("group", array(
            "id"=>"9",
            "approved"=>"0",
            "group_name"=>"useruser's group",
            "group_summary"=>"",
            "created_datetime"=>"2014-07-06 17:49:47",
            "popularity"=>"0",
            "is_recuiting"=>"0",
            "website_url"=>"",
            "contact_email"=>"useruser@useruser.com",
            "facebook_url"=>"",
            "is_auto_approved"=>"0",
            "icon_src"=>"",
            "apply_img"=>"",
        ) );




        // Data for table 'group_product'
        $this->insert("group_product", array(
            "id"=>"24",
            "group_id"=>"7",
            "price"=>"0",
            "created_datetime"=>"2014-07-06 17:47:40",
            "last_update_datetime"=>"2014-07-06 10:50:29",
            "img_src"=>"img/GroupProduct/7/24_1.png",
            "thumbnail_src"=>"img/GroupProduct/7/f24_1.jpg",
            "product_summary"=>"",
            "tag"=>"{*}1, {*}2, {*}3, {*}4, {*}5",
            "is_r18"=>"0",
            "is_bl"=>"0",
            "is_deleted"=>null,
            "product_catagory_enum"=>"1",
            "book_number_of_page"=>null,
            "book_inner_page_materia"=>"",
            "book_outer_page_materia"=>"",
            "gift_material"=>null,
            "elect_demo_url"=>null,
            "elect_is_selling"=>null,
            "elect_selling_url"=>null,
            "elect_size"=>null,
            "elect_format"=>null,
            "title"=>"admin's group product",
            "popularity"=>"2",
            "non_user_popularity"=>"2",
        ) );

        $this->insert("group_product", array(
            "id"=>"25",
            "group_id"=>"7",
            "price"=>"123",
            "created_datetime"=>"2014-07-06 17:51:46",
            "last_update_datetime"=>"2014-07-06 10:51:47",
            "img_src"=>"img/GroupProduct/7/25_1.png",
            "thumbnail_src"=>"img/GroupProduct/7/f25_1.jpg",
            "product_summary"=>"",
            "tag"=>"{*}1, {*}2, {*}3, {*}4",
            "is_r18"=>"0",
            "is_bl"=>"0",
            "is_deleted"=>null,
            "product_catagory_enum"=>"1",
            "book_number_of_page"=>null,
            "book_inner_page_materia"=>"",
            "book_outer_page_materia"=>"",
            "gift_material"=>null,
            "elect_demo_url"=>null,
            "elect_is_selling"=>null,
            "elect_selling_url"=>null,
            "elect_size"=>null,
            "elect_format"=>null,
            "title"=>"another group product",
            "popularity"=>"1",
            "non_user_popularity"=>"1",
        ) );




        // Data for table 'group_product_join_event'
        $this->insert("group_product_join_event", array(
            "product_id"=>"24",
            "event_id"=>"39",
        ) );

        $this->insert("group_product_join_event", array(
            "product_id"=>"25",
            "event_id"=>"39",
        ) );




        // Data for table 'group_tag_frequency'



        // Data for table 'groupproduct_posts_comments_nm'
        $this->insert("groupproduct_posts_comments_nm", array(
            "postId"=>"2",
            "commentId"=>"8",
        ) );




        // Data for table 'illust'
        $this->insert("illust", array(
            "id"=>"66",
            "created_datetime"=>"2014-07-06 17:41:16",
            "update_datetime"=>"2014-07-06 17:41:16",
            "popularity"=>"1",
            "illust_summary"=>"1
2
3
",
            "tag"=>"{~}abc, {~}123",
            "img_src"=>"img/Illust/adminadmin/66_1.png",
            "is_r18"=>"0",
            "is_bl"=>"0",
            "is_deleted"=>"0",
            "illust_category_enum"=>"1",
            "illust_title"=>"adminadmin's illust",
            "non_user_popularity"=>"1",
            "img_thumbnail_src"=>"img/Illust/adminadmin/f66_1.jpg",
        ) );

        $this->insert("illust", array(
            "id"=>"67",
            "created_datetime"=>"2014-07-06 17:49:15",
            "update_datetime"=>"2014-07-06 17:49:15",
            "popularity"=>"1",
            "illust_summary"=>"1
2
3
4
",
            "tag"=>"{~}abc",
            "img_src"=>"img/Illust/useruser/67_1.png",
            "is_r18"=>"0",
            "is_bl"=>"0",
            "is_deleted"=>"0",
            "illust_category_enum"=>"1",
            "illust_title"=>"useruser's illust",
            "non_user_popularity"=>"1",
            "img_thumbnail_src"=>"img/Illust/useruser/f67_1.jpg",
        ) );




        // Data for table 'illust_category'



        // Data for table 'illust_tag_frequency'



        // Data for table 'posts_comments_nm'
        $this->insert("posts_comments_nm", array(
            "postId"=>"1",
            "commentId"=>"1",
        ) );

        $this->insert("posts_comments_nm", array(
            "postId"=>"1",
            "commentId"=>"2",
        ) );

        $this->insert("posts_comments_nm", array(
            "postId"=>"2",
            "commentId"=>"6",
        ) );

        $this->insert("posts_comments_nm", array(
            "postId"=>"14",
            "commentId"=>"3",
        ) );

        $this->insert("posts_comments_nm", array(
            "postId"=>"14",
            "commentId"=>"4",
        ) );

        $this->insert("posts_comments_nm", array(
            "postId"=>"14",
            "commentId"=>"5",
        ) );

        $this->insert("posts_comments_nm", array(
            "postId"=>"17",
            "commentId"=>"7",
        ) );




        // Data for table 'product_catagory'



        // Data for table 'tbl_migration'
        $this->insert("tbl_migration", array(
            "version"=>"m000000_000000_base",
            "apply_time"=>"1404592048",
        ) );

        $this->insert("tbl_migration", array(
            "version"=>"m140626_160853_initial",
            "apply_time"=>"1404592053",
        ) );

        $this->insert("tbl_migration", array(
            "version"=>"m140705_203550_replace_data",
            "apply_time"=>"1404592053",
        ) );




        // Data for table 'update_log'



        // Data for table 'user'
        $this->insert("user", array(
            "id"=>"50",
            "sex"=>"",
            "website_url"=>"",
            "summary"=>"",
            "user_name"=>"adminadmin",
            "email"=>"adminadmin@adminadmin.com",
            "password"=>"10860056b4e603bbf13302fa5bfdedf2",
            "created_datetime"=>"2014-07-06 17:26:46",
            "icon_src"=>"",
            "show_r18"=>"0",
            "show_bl"=>"0",
            "accept_job"=>"0",
            "birthday"=>"1950-07-06",
            "is_admin"=>"1",
            "nickname"=>"adminadmin",
        ) );

        $this->insert("user", array(
            "id"=>"51",
            "sex"=>"",
            "website_url"=>"",
            "summary"=>"",
            "user_name"=>"useruser",
            "email"=>"useruser@useruser.com",
            "password"=>"7401b86acb8bcf1e6c8bedce5522e2d0",
            "created_datetime"=>"2014-07-06 17:48:42",
            "icon_src"=>"",
            "show_r18"=>"0",
            "show_bl"=>"0",
            "accept_job"=>"0",
            "birthday"=>"1950-07-06",
            "is_admin"=>"0",
            "nickname"=>"useruser",
        ) );




        // Data for table 'user_bookmark_illust'



        // Data for table 'user_follow_group'
        $this->insert("user_follow_group", array(
            "user_id"=>"51",
            "group_id"=>"7",
        ) );




        // Data for table 'user_follow_user'



        // Data for table 'user_member_group'
        $this->insert("user_member_group", array(
            "user_id"=>"50",
            "group_id"=>"7",
            "joinded_datetime"=>"2014-07-06 17:43:21",
            "is_leader"=>"1",
            "is_approved"=>"1",
        ) );

        $this->insert("user_member_group", array(
            "user_id"=>"50",
            "group_id"=>"8",
            "joinded_datetime"=>"2014-07-06 17:44:31",
            "is_leader"=>"1",
            "is_approved"=>"1",
        ) );

        $this->insert("user_member_group", array(
            "user_id"=>"51",
            "group_id"=>"7",
            "joinded_datetime"=>"2014-07-06 17:50:37",
            "is_leader"=>"0",
            "is_approved"=>"1",
        ) );

        $this->insert("user_member_group", array(
            "user_id"=>"51",
            "group_id"=>"9",
            "joinded_datetime"=>"2014-07-06 17:49:47",
            "is_leader"=>"1",
            "is_approved"=>"1",
        ) );




        // Data for table 'user_mq'



        // Data for table 'user_own_illust'
        $this->insert("user_own_illust", array(
            "user_id"=>"50",
            "illust_id"=>"66",
        ) );

        $this->insert("user_own_illust", array(
            "user_id"=>"51",
            "illust_id"=>"67",
        ) );




        // Data for table 'user_subscription'



        // Data for table 'user_viewed_group_product'
        $this->insert("user_viewed_group_product", array(
            "user_id"=>"50",
            "group_product_id"=>"24",
            "count"=>"1",
            "url_referrer"=>"http://localhost/memberCenter/createGroupProduct?mode=1",
            "view_datetime"=>"2014-07-06 17:47:41",
        ) );

        $this->insert("user_viewed_group_product", array(
            "user_id"=>"50",
            "group_product_id"=>"25",
            "count"=>"1",
            "url_referrer"=>"http://localhost/memberCenter/createGroupProduct?mode=1",
            "view_datetime"=>"2014-07-06 17:51:47",
        ) );

        $this->insert("user_viewed_group_product", array(
            "user_id"=>"51",
            "group_product_id"=>"24",
            "count"=>"1",
            "url_referrer"=>"http://localhost/group/index",
            "view_datetime"=>"2014-07-06 17:50:29",
        ) );




        // Data for table 'user_viewed_illust'
        $this->insert("user_viewed_illust", array(
            "user_id"=>"50",
            "illust_id"=>"66",
            "count"=>"1",
            "url_referrer"=>"http://localhost/memberCenter/createIllust?mode=1",
            "view_datetime"=>"2014-07-06 17:41:16",
        ) );

        $this->insert("user_viewed_illust", array(
            "user_id"=>"51",
            "illust_id"=>"67",
            "count"=>"1",
            "url_referrer"=>"http://localhost/memberCenter/createIllust?mode=1",
            "view_datetime"=>"2014-07-06 17:49:16",
        ) );

        if ($this->dbConnection->schema instanceof CMysqlSchema)
           $this->execute('SET FOREIGN_KEY_CHECKS = 1;');

	}

	public function safeDown() {
		if ($this->dbConnection->schema instanceof CMysqlSchema) {
           $this->execute('SET FOREIGN_KEY_CHECKS = 0;');
           $options = 'ENGINE=InnoDB DEFAULT CHARSET=utf8';
        } else {
           $options = '';
        }
		
		$this->truncateTable("comments");
        $this->truncateTable("event");
        $this->truncateTable("group");
        $this->truncateTable("group_product");
        $this->truncateTable("group_product_join_event");
        $this->truncateTable("group_tag_frequency");
        $this->truncateTable("groupproduct_posts_comments_nm");
        $this->truncateTable("illust");
        $this->truncateTable("illust_category");
        $this->truncateTable("illust_tag_frequency");
        $this->truncateTable("posts_comments_nm");
        $this->truncateTable("product_catagory");
        $this->truncateTable("tbl_migration");
        $this->truncateTable("update_log");
        $this->truncateTable("user");
        $this->truncateTable("user_bookmark_illust");
        $this->truncateTable("user_follow_group");
        $this->truncateTable("user_follow_user");
        $this->truncateTable("user_member_group");
        $this->truncateTable("user_mq");
        $this->truncateTable("user_own_illust");
        $this->truncateTable("user_subscription");
        $this->truncateTable("user_viewed_group_product");
        $this->truncateTable("user_viewed_illust");
		
		if ($this->dbConnection->schema instanceof CMysqlSchema)
           $this->execute('SET FOREIGN_KEY_CHECKS = 1;');
	}

}

?>
