Es wurde ein neuer Kommentar abgegeben in <?php echo $data['Comment']['model']; ?>

<?php echo ($this->Text->truncate($data['Comment']['body'])); ?>

Von <?php echo $data['Comment']['name']?> | <?php echo $data['Comment']['email']; ?> | <?php echo strftime("%X", strtotime($data['Comment']['created'])); ?>

<?php echo $this->Html->link('Zum Kommentar', 'http://' . $_SERVER['SERVER_NAME'] . '/comments/view/' . $data['Comment']['id']); ?>

