Du hast eine neue private Nachricht von <?php echo $data['sender']; ?> erhalten.



Betreff: <?php echo $data['message']['Message']['subject']; ?>

-------------------------------------------------------------------------------

<?php echo wordwrap ($data['message']['Message']['body']); ?>

-------------------------------------------------------------------------------

Zum Posteingang: http://www.the-asstereoidiots.de/messages/inbox
