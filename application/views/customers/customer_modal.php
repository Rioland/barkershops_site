<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button data-dismiss="modal" class="close" type="button">×</button>
			<h3><?php echo lang("customers_basic_information"); ?></h3>
		</div>
		<div class="modal-body nopadding">
			<table class="table table-bordered table-hover table-striped" width="1200px">
				<tr>
					<td>
						<?php echo lang('giftcards_customer_name'); ?>	
					</td>
					<td>
						<?php echo H($customer_info->first_name.' '.$customer_info->last_name); ?>
					</td>
				</tr>
				<tr>
					<td>
						<?php echo lang('common_address_1'); ?>
					</td>
					<td>
						<?php echo H($customer_info->address_1); ?>
					</td>
				</tr>
				<tr>
					<td>
						<?php echo lang('common_address_2'); ?>
					</td>
					<td>
						<?php echo H($customer_info->address_2); ?>
					</td>
				</tr>
				<tr>
					<td>
						<?php echo lang('common_city'); ?>
					</td>
					<td>
						<?php echo H($customer_info->city); ?>
					</td>
				</tr>
				<tr>
					<td>
						<?php echo lang('common_state'); ?>
					</td>
					<td>
						<?php echo H($customer_info->state); ?>
					</td>
				</tr>
				<tr>
					<td>
						<?php echo lang('common_country'); ?>
					</td>
					<td>
						<?php echo H($customer_info->country); ?>
					</td>
				</tr>
				<tr>
					<td>
						<?php echo lang('common_zip'); ?>
					</td>
					<td>
						<?php echo H($customer_info->zip); ?>
					</td>
				</tr>
				
			</table>
		</div>
	</div>
</div>



