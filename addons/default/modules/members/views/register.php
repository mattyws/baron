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
        $("#birth").mask("99/99/9999",{placeholder:"dd/mm/yyyy"});
        $("#tel").mask("(99)9999-9999");
    });
</script>

<div id="add-members">
    <?php echo form_open_multipart("members/register"); ?>
    <img id="userphoto" src="./uploads/members/nophoto.png">
    <div class="input" style="padding-left: 30%;">         
        <?php echo form_upload("userfile", "", 'id="userfile"') ?>
    </div>
    <div class="label">
        <label><?php echo lang("members:name"); ?></label>
    </div>
    <div class="input">
        <?php echo form_input("name", "", 'id="name"'); ?>
    </div>

    <div class="label">
        <label><?php echo lang("members:email"); ?></label>
    </div>
    <div class="input">
        <?php echo form_input("email", "", 'id="email"'); ?>
    </div>

    <div class="label">
        <label><?php echo lang("members:tel"); ?></label>
    </div>
    <div class="input">
        <?php echo form_input("tel", "", 'id="tel"'); ?>
    </div>

    <div class="label">
        <label><?php echo lang("members:birth"); ?></label>
    </div>
    <div class="input">
        <?php echo form_input("birth", "", 'id="birth"'); ?>
    </div>

    <div class="label">
        <label><?php echo lang("members:rga"); ?></label>
    </div>
    <div class="input">
        <?php echo form_input("rga", "", 'id="rga"'); ?>
    </div>

    <div class="label">
        <label><?php echo lang("members:course"); ?></label>
    </div>
    <div class="input">
        <?php echo form_input("course", "", 'id="course"'); ?>
    </div>

    <div class="label">
        <label><?php echo lang("members:campus"); ?></label>
    </div>
    <div class="input">
        <?php echo form_input("campus", "", 'id="campus"'); ?>
    </div>
    <div class="input" style="padding-left: 47%;">
        <?php echo form_submit("", "Enviar", 'id="submit"'); ?>
    </div>
    <?php echo form_close(); ?>
</div>