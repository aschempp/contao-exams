<div class="<?php echo $this->class; ?>">
<p><?php echo $this->question; ?></p>
<?php if (strlen($this->description_intro)): ?>

<div class="intro"><?php echo $this->description_intro; ?></div>
<?php endif; ?>
<?php echo $this->field; ?>
<?php if ($this->showFeedback): ?>

<div class="feedback"><?php echo $this->feedback; ?></div>
<?php endif; ?>
<?php if (strlen($this->description_extro)): ?>

<div class="extro"><?php echo $this->description_extro; ?></div>
<?php endif; ?>
</div>