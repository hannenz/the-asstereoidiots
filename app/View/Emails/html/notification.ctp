<h2 style="color:#27221F; font-size: 24px; letter-spacing:-1px; font-family:Helvetica,Arial,sans-serif;">Kommentarbenachrichtigung</h2>
<h3 style="color:#27221F; font-size: 20px; letter-spacing:-1px; font-family:Helvetica,Arial,sans-serif;">Es wurde ein neuer Kommentar abgegeben in <?php echo $data['Comment']['model']; ?></h3>
<p style="font-family:'Lucida Grande',Verdana,Helvetica,Arial,sans-serif; line-height: 15px; font-size: 11px;">Von <?php echo $data['Comment']['name']?> | <?php echo $data['Comment']['email']; ?> | <?php echo strftime("%X", strtotime($data['Comment']['created'])); ?></p>
<p style="font-family:'Lucida Grande',Verdana,Helvetica,Arial,sans-serif; line-height: 15px; font-size: 11px;"><?php echo nl2br($this->Text->truncate($data['Comment']['body'])); ?></p>
<p style="font-family:'Lucida Grande',Verdana,Helvetica,Arial,sans-serif; line-height: 15px; font-size: 11px;"><?php echo $this->Html->link('Zum Kommentar', 'http://' . $_SERVER['SERVER_NAME'] . '/comments/view/' . $data['Comment']['id']); ?></p>
