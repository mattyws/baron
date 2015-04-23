<?php if ($this->method == 'edit'): ?>
    <section class="title">
        <h4><?php echo sprintf(lang('members:edit_title'), $member->name); ?></h4>
    </section>
<?php else: ?>
    <section class="title">
        <h4><?php echo lang('members:add_title'); ?></h4>
    </section>
<?php endif; ?>

<script type="text/javascript">
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#userphoto').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    function imageIsLoaded(e) {
        $('#userphoto').attr('src', e.target.result);
    }

    $(document).ready(function (e) {
        $("#userfile").change(function () {
            var file = this.files[0];
            var imagefile = file.type;
            var match = ["image/jpeg", "image/png", "image/jpg"];
            if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
                $('#userphoto').attr('src', 'noimage.png');
                return false;
            } else {
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
            }
        });
        $("#birth").mask("99/99/9999", {placeholder: "dd/mm/yyyy"});
        $("#nextPayment").mask("99/99/9999", {placeholder: "dd/mm/yyyy"});
        $("#payment").mask("99/99/9999", {placeholder: "dd/mm/yyyy"});
        $("#tel").mask("(99)9999-9999");
    });
</script>

<section class="item">
    <div class="content">
        <?php echo form_open_multipart(uri_string(), 'class="crud"'); ?>
        <?php
        if ($this->method == 'edit')
            echo form_hidden('id', $member->id);
        ?>
        <div class="form_inputs">
            <ul>
                <li>
                    <img id="userphoto" src="<?php echo $member->relative; ?>">                
                    <?php echo form_upload("userfile", "", 'id="userfile"') ?>                

                </li>
                <li>
                    <label><?php echo lang("members:name"); ?> <span>*</span></label>
                    <div class="input">
                        <?php echo form_input("name", $member->name, 'id="name"'); ?>
                    </div>

                </li>
                <li>
                    <label><?php echo lang("members:email"); ?> <span>*</span></label>
                    <div class="input">
                        <?php echo form_input("email", $member->email, 'id="email"'); ?>
                    </div>
                </li>

                <li>
                    <label><?php echo lang("members:tel"); ?> <span>*</span></label>
                    <div class="input">
                        <?php echo form_input("tel", $member->tel, 'id="tel"'); ?>
                    </div>
                </li>
                <li>
                    <label><?php echo lang("members:birth"); ?></label>
                    <div class="input">
                        <?php echo form_input("birth", $member->birth, 'id="birth"'); ?>
                    </div>
                </li>
                <li>
                    <label><?php echo lang("members:rga"); ?></label>
                    <div class="input">
                        <?php echo form_input("rga", $member->rga, 'id="rga"'); ?>
                    </div>
                </li>
                <li>
                    <label><?php echo lang("members:course"); ?></label>
                    <div class="input">
                        <?php echo form_input("course", $member->course, 'id="course"'); ?>
                    </div>
                </li>   
                <li>
                    <label><?php echo lang("members:campus"); ?></label>
                    <div class="input">
                        <?php echo form_input("campus", $member->campus, 'id="campus"'); ?>
                    </div>
                </li>   
                <li>
                    <label><?php echo lang("members:payment"); ?></label>
                    <div class="input">
                        <?php echo form_input("payment", $member->payment, 'id="payment"'); ?>
                    </div>
                </li>  
                <li>
                    <label><?php echo lang("members:nextPayment"); ?></label>
                    <div class="input">
                        <?php echo form_input("nextPayment", $member->nextPayment, 'id="nextPayment"'); ?>
                    </div>
                </li>  
            </ul>

        </div>

        <div class="buttons">
            <?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel'))); ?>
        </div>	
    </div>
    <?php echo form_close(); ?>



</section>