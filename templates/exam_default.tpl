
<!-- indexer::stop -->
<div class="<?php echo $this->class; ?> block"<?php echo $this->cssID; ?><?php if ($this->style): ?> style="<?php echo $this->style; ?>"<?php endif; ?>>
<?php if ($this->title): ?>

<h1><?php echo $this->title; ?></h1>
<?php endif; if (strlen($this->message)): ?>

<div class="<?php echo $this->mclass; ?>"><?php echo $this->message; ?></div>
<?php endif; ?>
<?php if (strlen($this->countdown)) echo $this->countdown; ?>

<form action="<?php echo $this->action; ?>" id="<?php echo $this->formId; ?>" method="post">
<div class="formbody">
<input type="hidden" name="FORM_SUBMIT" value="<?php echo $this->formSubmit; ?>" />
<input type="hidden" name="REQUEST_TOKEN" value="{{request_token}}">
<?php echo $this->questions; ?>
<div class="submit_container"><input type="submit" class="submit" value="<?php echo $this->slabel; ?>"<?php echo $this->sattributes; ?> /></div>
</form>
<?php echo $this->pagination; ?>

</div>
<!-- indexer::continue -->