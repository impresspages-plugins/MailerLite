<div class="ip ipWidget-MailerLite">
    <div id="ipsWidgetMailerLitePopup" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><?php echo __('MailerLite widget settings', 'ipAdmin') ?></h4>
                </div>

                <div class="modal-body">
                    <?php
                    echo $commercial->render();
                    ?>
                    <div class="_form">
                    <?php
                    echo $form->render();
                    ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo __('Cancel', 'ipAdmin') ?></button>
                    <button type="button" class="btn btn-primary ipsConfirm"><?php echo __('Confirm', 'ipAdmin') ?></button>
                </div>
            </div>
        </div>
    </div>
</div>
