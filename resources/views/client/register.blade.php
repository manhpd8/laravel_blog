<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">


<div class="container register-form">
    <div class="form">
        <div class="note">
            <p>Register account</p>
        </div>

        <form class="form-content" action="" method="post">
        	{{ csrf_field() }}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group"> 
                        <input type="text" class="form-control" placeholder="Your Name *"  required="" name="user_name" />
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Phone Number *" required="" name="user_phone" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Your Password *" required="" name="user_pass" />
                    </div>
                    <!-- <div class="form-group">
                        <input type="text" class="form-control" placeholder="Confirm Password *" required="" id="user_pass_confirm" />
                    </div> -->
                </div>
            </div>
            <div style="text-align: center;"><button class="btnSubmit" type="submit">Submit</button></div>
        </form>
    </div>
</div>
<style type="text/css">
.note
{
    text-align: center;
    height: 80px;
    background: -webkit-linear-gradient(left, #0072ff, #8811c5);
    color: #fff;
    font-weight: bold;
    line-height: 80px;
}
.form-content
{
    padding: 5%;
    border: 1px solid #ced4da;
    margin-bottom: 2%;
}
.form-control{
    border-radius:1.5rem;
}
.btnSubmit
{
    border:none;
    border-radius:1.5rem;
    padding: 1%;
    width: 20%;
    cursor: pointer;
    background: #0062cc;
    color: #fff;
}
</style>
<script type="text/javascript">
	function onclickSubmit(ele){
		var pass = document.getElementById('user_pass').value;
		var passConfirm = document.getElementById('user_pass_confirm').value;
		if(pass == passConfirm){
			ele.type = 'submit';
		} else{
			alert('pass khong khop')
		}
		
	}
</script>