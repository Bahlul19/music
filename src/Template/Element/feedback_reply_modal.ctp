<div id="feedbackReplyModel" class="modal fade pack-modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Send Email</h4>
			</div>

			<div class="modal-body">
				<?php echo $this->Form->create('UserFeedbackEmail', array('url' => array('controller' => 'feedbacks', 'action' => 'feedbackreply'))); ?>
					<div class="form-group">
						<label>To</label>
						<input type="email" name="fbRecepient" id="fbRecepient" class="form-control" readonly>
					</div>
					<div class="form-group">

						<?php
							echo $this->Form->input('sender_email', array(
								'class' => 'form-control',
								'label' => 'From',
								'default' => $this->request->getSession()->read('Auth')['User']['email'],
								'readonly' => 'true'
								)
							);
						?>
					</div>
					<div class="form-group">
						<?php
							echo $this->Form->input('subject', array(
								'class' => 'form-control subject',
								'label' => 'Subject',
								'rows' => 1,
								'required' => true
								)
							);
						?>
					</div>
					<div class="form-group">
						<?php
							echo $this->Form->textarea('content', array(
								'class' => 'form-control content',
								'label' => 'Content',
								'rows' => 5,
								'required' => true
								)
							);
						?>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<?php
								echo $this->Form->submit(__('Submit'), array(
									'class' => 'btn btn-primary admin-btn',
									'div' => false
									)
								);
							?>
						</div>
					</div>
					<input type="hidden" name="fbid" id="fbid" class="form-control">
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>
</div>
