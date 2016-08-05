<?=$this->Form->input('redirect', array('value' => $redirect, 'type' => 'hidden'))?>
<?=$this->Form->input('name')?><br />
<?=$this->Form->input('address1')?><br />
<?=$this->Form->input('address2')?><br />
<?=$this->Form->input('country')?><br />
<?=$this->Form->input('zip')?><br />
<?=$this->Form->input('city')?><br />
<?=$this->Form->input('contact')?><br />
<?=$this->Form->input('email')?><br />
<?=$this->Form->input('phone')?><br />
<?=$this->Form->input('phone2')?><br />
<?=$this->Form->input('url')?><br />
<?=$this->Form->input('user_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id')))?><br />

<?=$this->Form->submit()?><br />
<?=$this->Form->end()?>
