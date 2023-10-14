<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
	pageEncoding="ISO-8859-1"%>
<%@ taglib prefix="form" uri="http://www.springframework.org/tags/form"%>
<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core"%>

<!DOCTYPE html>

<head>
    <meta charset="ISO-8859-1">
    <title>Edit WashingMachine</title>

    <link rel="stylesheet"
        	href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script
        	src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script
        	src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</head>
<body>

    <div class="container">

        <h1 class="p-3"> Edit WashingMachine </h1>

        <form:form action="/editSaveWashingMachine" method="post" modelAttribute="washingMachine">

                    <div class="row">
                    	<div class="form-group col-md-12">
                    		<div class="col-md-6">
                    			<form:hidden path="id" class="form-control input-sm" />
                    		</div>
                    	</div>
                    </div>

                    <div class="row">
                    	<div class="form-group col-md-12">
                    		<label class="col-md-3" for="producer">producer</label>
                    		<div class="col-md-6">
                    		    <form:input type="text" path="producer" id="producer"
                    		        class="form-control input-sm" required="required" />
                    		</div>
                    	</div>
                    </div>

                    <div class="row">
                    	<div class="form-group col-md-12">
                    		<label class="col-md-3" for="tankCapacity">tankCapacity</label>
                    		<div class="col-md-6">
                    			<form:input type="number" path="tankCapacity" id="tankCapacity"
                    				class="form-control input-sm" required="required" />
                    		</div>
                    	</div>
                    </div>

					<div class="row">
						<div class="form-group col-md-12">
							<label class="col-md-3" for="sellerId">sellerId</label>
							<div class="col-md-6">
								<form:input type="number" path="sellerId" id="sellerId"
											class="form-control input-sm" required="required" />
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group col-md-12">
							<label class="col-md-3" for="productType">productType</label>
							<div class="col-md-6">
								<form:input type="text" path="productType" id="productType"
											class="form-control input-sm" required="required" />
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group col-md-12">
							<label class="col-md-3" for="price">price</label>
							<div class="col-md-6">
								<form:input type="number" path="price" id="price"
											class="form-control input-sm" required="required" />
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-group col-md-12">
							<label class="col-md-3" for="name">name</label>
							<div class="col-md-6">
								<form:input type="text" path="name" id="name"
											class="form-control input-sm" required="required" />
							</div>
						</div>
					</div>

                    <div class="row p-2">
                    	<div class="col-md-2">
                    		<button type="submit" value="Register" class="btn btn-success">Save</button>
                    	</div>
                    </div>

                </form:form>

    </div>

    <script th:inline="javascript">
                window.onload = function() {

                    var msg = "${message}";
                    console.log(msg);
                    if (msg == "Edit Failure") {
        				Command: toastr["error"]("Something went wrong with the edit.")
        			}

        			toastr.options = {
                          "closeButton": true,
                          "debug": false,
                          "newestOnTop": false,
                          "progressBar": true,
                          "positionClass": "toast-top-right",
                          "preventDuplicates": false,
                          "showDuration": "300",
                          "hideDuration": "1000",
                          "timeOut": "5000",
                          "extendedTimeOut": "1000",
                          "showEasing": "swing",
                          "hideEasing": "linear",
                          "showMethod": "fadeIn",
                          "hideMethod": "fadeOut"
                        }
        	    }
            </script>

</body>

</html>