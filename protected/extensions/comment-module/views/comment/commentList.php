<?php

/** @var CArrayDataProvider $comments */
$comments = $model->getCommentDataProvider();
$comments->setPagination(false);
?>

		<?php
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$comments,
	'itemView'=>'comment.views.comment._view'
));
?>

			<!-- CONTACT FORM -->
                        <?php
$this->renderPartial('comment.views.comment._form', array(
	'comment'=>$model->commentInstance
));
?>
