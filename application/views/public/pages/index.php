<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <?php
                if ($this->session->flashdata('success')) {
                    echo $this->session->flashdata('success');
                }

                if ($this->session->flashdata('error')) {
                    echo $this->session->flashdata('error');
                }
            ?>
            
            <ul class="list-group row" id="domains">

            </ul>

        </div>
    </div>
</div>

<!-- line modal -->
<div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="getCode">

        </div>
    </div>
</div>

<script type="text/javascript">

    $(function () {
        $(window).load(function () {

            $.ajax({
                url: "<?php echo site_url('welcome/get_list'); ?>",
                type: "post",
                success: function (text)
                {
                    $('#domains').html(text);
                }
            });
        });
    });

    function showId(obj) {

        var id = obj;

        $.ajax({
            url: "<?php echo site_url('welcome/getCredential'); ?>",
            type: "post",
            data: {'domain_id': id, 'user_id': <?php echo $this->session->userdata('id') ?>, },
            success: function (text)
            {
                $("#getCode").html(text);

                $("#squarespaceModal").modal('show');

            }
        });

        /*$.ajax({
            url: "<?php //echo site_url('welcome/cenckValidity'); ?>",
            type: "post",
            data: {'domain_id': id, 'user_id': <?php //echo $this->session->userdata('id') ?>, },
            success: function (text)
            {
                $("#getCode").html(text);

                $("#squarespaceModal").modal('show');

            }
        });*/

    }
    
    function showContent(domainid) {

        var array = domainid.split(',');
        
        console.log(array);
        
        $.ajax({
            url: "<?php echo site_url('welcome/cenckValidity'); ?>",
            type: "post",
            data: {'domain_id': array[0], 'credential_id': array[1], 'user_id': <?php echo $this->session->userdata('id') ?>, },
            success: function (text)
            {
                $("#getCode").html(text);

                $("#squarespaceModal").modal('show');

            }
        });

    }

    function edit(obj) {

        var id = obj;

        $.ajax({
            url: "<?php echo site_url('welcome/editInfo'); ?>",
            type: "post",
            data: {'id': id},
            success: function (text)
            {
                $("#getCode").html(text);

                $("#squarespaceModal").modal('show');

            }
        });



    }

</script>



