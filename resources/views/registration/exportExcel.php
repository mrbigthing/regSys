<?php
/*header("Content-type:application/vnd.ms-excel"); 
header("Content-Disposition:attachment; filename=".date('Y-m-d h-i-s').".xls");

echo "name".chr(9);
echo "ID".chr(9);
echo "phone".chr(9);
echo chr(13);

foreach ($users as $user) {
	echo $user->user_name.chr(9);
	echo $user->user_identi_card.chr(9);
	echo $user->user_phone.chr(9);

	$family_json = json_decode($user->family_members);

	if (!empty($family_json)) {
		foreach($family_json as $family){
			echo chr(13);
			echo $family->name.chr(9);
			echo $family->identi_card.chr(9);
		}
	}
	echo chr(13);
}*/
?>
<?php
	Excel::create(date('Y-m-d h-i-s'), function($excel) use ($users) {
	    $excel->sheet('名单', function($sheet) use ($users) {
			$sheet->setColumnFormat(array(
				'A' => '@',
				'B' => '@',
				'C' => '@'));

	    	$sheet->row(1, array(
			     '姓名', '身份证号', '电话'
			));

			$sheet->row(1, function($row) {
			    $row->setBackground('#e9faff');
			    $row->setFontColor('#337b92');
			});

	    	$index = 2;
	    	foreach ($users as $user) {
				$sheet->row($index,  array($user->user_name, $user->user_identi_card, $user->user_phone));

				$sheet->row($index, function($row) {
				    $row->setBackground('#eeffe7');
				    $row->setFontColor('#3c763d');
				});

				$index++;

				$family_json = json_decode($user->family_members);

				if (!empty($family_json)) {
					foreach($family_json as $family){
						$sheet->row($index,  array($family->name, $family->identi_card));
						$sheet->row($index, function($row) {
							    $row->setBackground('#fffbe6');
							    $row->setFontColor('#7d6c00');
						});
						$index++;
					}
				}
			}

		    $sheet->cells('A1:A'.$index, function($cells) {
		    	$cells->setFontSize(16);
		    	$cells->setAlignment('center');
		    	$cells->setValignment('middle');
			});

			$sheet->cells('B1:B'.$index, function($cells) {
		    	$cells->setFontSize(16);
		    	$cells->setAlignment('center');
		    	$cells->setValignment('middle');
			});

			$sheet->cells('C1:C'.$index, function($cells) {
		    	$cells->setFontSize(16);
		    	$cells->setAlignment('center');
		    	$cells->setValignment('middle');
			});

			$sheet->setWidth(array(
			    'A'     =>  30,
			    'B'     =>  50,
			    'C'     =>  40
			));

			for($i=1; $i<$index; $i++) {
				$sheet->setHeight($i, 30);
			}
	    });

	    
	})->download('xls');
?>