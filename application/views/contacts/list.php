<link href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.0/css/bootstrap.css" rel="stylesheet" media="screen">
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.0/js/bootstrap.min.js"></script>
<style>
.btn-custom {
  background: #1ABC9C;
  color: #FFF;
  /* margin-right: 10px; */
} 
</style>
<body>
<div class="container">
    <!-- Button to trigger modal --> 
    <a href="#myModal" role="button" class="btn btn-custom pull-right" data-toggle="modal">Add Contact</a>
    <div>
      <form class="form-horizontal" id="searchform" name="searchform" method="post" action="">
        <label class="control-label col-md-4" for="name">Name</label>
        <input type="text" class="form-control" id="search_name" name="search_name" placeholder="Name"/>
        <button type="button" value="Submit" class="btn btn-custom pull-right" id="search_btn">Search</button>
      </form>
    </div>
    <!-- Modal -->
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Contact Form</h4>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" name="contactform" method="post" action="">
                <div class="form-group">
                    <label class="control-label col-md-4" for="name">Name</label>
                    <div id="div-name" class="col-md-6">
                      <input type="text" class="form-control" id="name" name="cnt_name" placeholder="Name"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4" for="address">Address</label>
                    <div id="div-address" class="col-md-6">
                        <textarea rows="6" class="form-control" id="address" name="cnt_address" placeholder="Address details"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4" for="email">Email Address</label>
                    <div id="div-email" class="col-md-6">
                      <input type="text" class="form-control" id="email" name="cnt_email" placeholder="Email Address"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4" for="phone">Phone</label>
                    <div id="div-phone" class="col-md-6">
                      <input type="phone" class="form-control" id="phone" name="cnt_phone" placeholder="Phone Number"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-8">
                        <button type="submit" value="Submit" class="btn btn-custom pull-right" id="send_btn">Send</button>
                    </div>
                </div>
            </form>
        </div><!-- End of Modal body -->
        </div><!-- End of Modal content -->
        </div><!-- End of Modal dialog -->
    </div><!-- End of Modal -->
    <div class="box-body table-responsive">
      <table class="table table-hover">
        <tr>
          <th>Name</th>
          <th>Address</th>
          <th>Email</th>
          <th>Phone</th>
          <th class="text-center">Actions</th>
        </tr>
        <?php
        if(!empty($contact_data))
        {
            foreach($contact_data as $list)
            {
        ?>
        <tr id="<?php echo $list['cnt_id'] ?>">
          <td><?php echo $list['cnt_name'] ?></td>
          <td><?php echo $list['cnt_address'] ?></td>
          <td><?php echo $list['cnt_email'] ?></td>
          <td><?php echo $list['cnt_phone'] ?></td>
          <td class="text-center">
              <a class="btn btn-sm btn-danger deleteContact" href="#" data-userid="<?php echo $list['cnt_id']; ?>"><i class="fa fa-trash">delete</i></a>
          </td>
        </tr>
        <?php
            }
        }
        ?>
      </table>
      
    </div><!-- /.box-body -->

    <div class="box-footer clearfix">
        <?php echo $this->pagination->create_links(); ?>
    </div>
</div><!-- End of Container -->

</body>

<script>
  $(function () {

    
    $('#search_btn').click(function(event) {
      $('#searchform')[0].submit();
    });

    $('form').on('submit', function (e) {

      e.preventDefault();

      //Validation
      var $inputs = $('form :input');
      var values = {};

      $inputs.each(function() {
        console.log($(this).val());
      });
      //End Validation
      var error=0;

      $.each($('form').serializeArray(), function(i, field) {
        //values[field.name] = field.value;
        if(field.name == 'cnt_name') {
          if(field.value == '' || field.value.length < 5 || field.value.length > 25) {
            error=1;
            $('#div-name').addClass('has-error');
          } else {
            $('#div-name').removeClass('has-error');
          }
        }

        if(field.name == 'cnt_address') {
          if(field.value == '' || field.value.length < 5 || field.value.length > 25) {
            error=1;
            $('#div-address').addClass('has-error');
          } else {
            $('#div-address').removeClass('has-error');
          }
        }

        if(field.name == 'cnt_email') {
          if(field.value == '' || field.value.length < 5 || field.value.length > 25 || !isValidEmail(field.value)) {
            error=1;
            $('#div-email').addClass('has-error');
          } else {
            $('#div-email').removeClass('has-error');
          }
        }
        if(field.name == 'cnt_phone') {
          if(field.value == '' || field.value.length < 5 || field.value.length > 25) {
            error=1;
            $('#div-phone').addClass('has-error');
          } else {
            $('#div-phone').removeClass('has-error');
          }
        }
      });
      
      if(!error) {
        $.ajax({
          type: 'post',
          dataType: 'json',
          url: '<?php echo base_url()?>/contacts/create',
          data: $('form').serialize(),
          success: function (response) {

            if(response.error_status == 0) {
              alert("error");
            } else {
              location.reload();
            }
            //location.reload();
          }
        });
      } else {
        alert("error");
      }
    });

  });

function isValidEmail(sEmail) {
  var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
  if (filter.test(sEmail)) {
    return true;
  } else {
    return false;
  }
}
</script>