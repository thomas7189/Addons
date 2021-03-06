<?php if (!defined('APPLICATION')) exit();
$Session = Gdn::Session();
$CancelUrl = '/vanilla/discussions';
if (C('Vanilla.Categories.Use') && is_object($this->Category))
   $CancelUrl = '/vanilla/categories/'.urlencode($this->Category->UrlCode);

?>
<div id="DiscussionForm" class="FormTitleWrapper DiscussionForm">
   <?php
		if ($this->DeliveryType() == DELIVERY_TYPE_ALL)
			echo Wrap($this->Data('Title'), 'h1', array('class' => 'H'));
	
      echo '<div class="FormWrapper">';
      echo $this->Form->Open();
      echo $this->Form->Errors();
      if ($this->ShowCategorySelector === TRUE) {
			echo '<div class="P">';
				echo '<div class="Category">';
				echo $this->Form->Label('Category', 'CategoryID'), ' ';
				echo $this->Form->CategoryDropDown('CategoryID', array('Value' => GetValue('CategoryID', $this->Category)));
				echo '</div>';
			echo '</div>';
      }
      
      echo '<div class="P">';
			echo $this->Form->Label('Question', 'Name');
			echo Wrap($this->Form->TextBox('Name', array('maxlength' => 100, 'class' => 'InputBox BigInput')), 'div', array('class' => 'TextBoxWrapper'));
		echo '</div>';
		echo '<div class="P">';
         echo $this->Form->BodyBox('Body', array('Table' => 'Discussion'));
		echo '</div>';
      echo '<div class="Buttons">';
      echo $this->Form->Button((property_exists($this, 'Discussion')) ? 'Save' : 'Ask Question', array('class' => 'Button Success DiscussionButton'));
      if (!property_exists($this, 'Discussion') || !is_object($this->Discussion) || (property_exists($this, 'Draft') && is_object($this->Draft))) {
         echo $this->Form->Button('Save Draft', array('class' => 'Button Warning DraftButton'));
      }
      echo $this->Form->Button('Preview', array('class' => 'Button Warning PreviewButton'));
      echo Anchor(T('Cancel'), $CancelUrl, 'Cancel');
      echo '</div>';
      echo $this->Form->Close();
      echo '</div>';
   ?>
</div>
