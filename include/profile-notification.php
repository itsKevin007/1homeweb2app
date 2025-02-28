<?php
	$userId = $_SESSION['user_id'];
	$sqlLocation = $conn->prepare("SELECT * FROM tbl_location WHERE user_id = :userId");
	$sqlLocation->bindParam(':userId', $userId, PDO::PARAM_INT);
	$sqlLocation->execute();
	$addLoc = $sqlLocation->rowCount();

	if ($accesslevel == 0) {
		$client = $conn->prepare("SELECT zipcode, bank, branch, accname, accnum, user_id FROM bs_client WHERE user_id = :userId");
		$client->bindParam(':userId', $userId, PDO::PARAM_INT);
		$client->execute();
		$client_data = $client->fetch();

		$zip = $client_data['zipcode'];

		$bank = $client_data['bank'];
		$branch = $client_data['branch'];
		$accname = $client_data['accname'];
		$accnum = $client_data['accnum'];

		if ($zip == '' || $bank == '' || $branch == '' || $accname == '' || $accnum == '') 
			{
				$required = 1;
			}else{
				$required = 0;
			}

	} elseif ($accesslevel == 1) {
		$independent = $conn->prepare("SELECT zipc, bank, branch, accname, accno FROM tbl_independent WHERE user_id = :userId");
		$independent->bindParam(':userId', $userId, PDO::PARAM_INT);
		$independent->execute();
		$ind_data = $independent->fetch();

		$zip = $ind_data['zipc'];

		$bank = $ind_data['bank'];
		$branch = $ind_data['branch'];
		$accname = $ind_data['accname'];
		$accno = $ind_data['accno'];

		if ($zip == '' || $bank == '' || $branch == '' || $accname == '' || $accno == '') 
			{
				$required = 1;
			}else{
				$required = 0;
			}

	} elseif ($accesslevel == 2) {
		$company = $conn->prepare("SELECT * FROM tbl_company WHERE user_id = :userId");
		$company->bindParam(':userId', $userId, PDO::PARAM_INT);
		$company->execute();
		$company_data = $company->fetch();

		$zip = $company_data['zipc'];

		$bank = $company_data['bank'];
		$branch = $company_data['branch'];
		$accname = $company_data['accname'];
		$accno = $company_data['accno'];

		if ($zip == '' || $bank == '' || $branch == '' || $accname == '' || $accno == '') 
			{
				$required = 1;
			}else{
				$required = 0;
			}

	}

	if($required != 0 && $addLoc != 0){
		$requirements = 'style="color: red;"';
	}else{
		$requirements = '';
	}

?>