<?php 
	function screencap() {
	  ob_start();

		system('adb shell screencap -p /sdcard/screen.png');
		system('adb pull /sdcard/screen.png .');

	  ob_end_clean();
	}

	function new_cut($tag){
		$src_img = 'screen.png';
		$number = array(
			'0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000',
			'0000000000001110000000001000000000100000000010000000001000000000100000000010000000000000000000000000',
			'0001110000001101100000100110000000010000000011000000011000000011111000001111100000000000000000000000',
			'0001110000001101100000000110000001110000000001000000000110000011011000000110000000000000000000000000',
			'0000010000000011000000011100000001010000001001000000111110000000010000000001000000000000000000000000',
			'0001111000001100000000110000000011110000000001100000000110000011011000000111000000000000000000000000',
			'0000110000000110000000110000000011110000001001100000100010000011011000000111000000000000000000000000',
			'0011111000000001100000000100000000110000000010000000001000000001100000000100000000000000000000000000',
			'0001110000001101100000100110000001110000001101000000100110000011011000000111000000000000000000000000',
			'0001100000001101000000100110000010011000001111100000000100000000110000000110000000000000000000000000'
		);
		$size = getimagesize($src_img);
		$ename=explode('/',$size['mime']); 
        $ext=$ename[1]; 
        switch($ext){ 
			case "png": 
				$source=imagecreatefrompng($src_img); 
			break; 
			case "jpeg": 
				$source=imagecreatefromjpeg($src_img); 
			break; 
			case "jpg": 
				$source=imagecreatefromjpeg($src_img); 
			break; 
			case "gif": 
				$source=imagecreatefromgif($src_img); 
			break; 
        } 
        foreach ($tag as $k => $v) {
        	$croped=imagecreatetruecolor(10, 10);
	        imagecopyresized($croped, $source, 0, 0, $v[1]+4, $v[2]+4,10, 10,110, 110);
	        $data = "";
			for($i=0; $i < 10; ++$i)
			{
				for($j=0; $j < 10; ++$j)
				{
					$rgb = imagecolorat($croped,$j,$i);
					$rgbarray = imagecolorsforindex($croped, $rgb);
					if($rgbarray['red'] < 125 || $rgbarray['green']<125
					|| $rgbarray['blue'] < 125)
					{
						$data.='1';
					}else{
						$data.='0';
					}
				}
			}
			$num = 0;
			foreach($number as $key => $value)
			{
				if ($data==$value) {
					$num = $key;
					break;
				}
			}
			// $datas['fig'.($k+1)] = $num;
			$sudoku_arr[floor($k/9)][$k%9] = $num;
			imagedestroy($croped);
        }
        return $sudoku_arr;
	}

	function press($postion,$num) {
		$time = '1';
	    // 随机点按下和稍微挪动抬起，模拟手指
	    // $px = rand(300,400);
	    // $py = rand(400,600);
	    $px = $postion[1]+57;
    	$py = $postion[2]+57;
	    system('adb shell input tap ' . $px . ' ' . $py);
	    $number = array(
	    	'1'=>sprintf("%s %s", 115, 1576),
	    	'2'=>sprintf("%s %s", 322, 1576),
	    	'3'=>sprintf("%s %s", 538, 1576),
	    	'4'=>sprintf("%s %s", 755, 1576),
	    	'5'=>sprintf("%s %s", 970, 1576),
	    	'6'=>sprintf("%s %s", 115, 1710),
	    	'7'=>sprintf("%s %s", 322, 1710),
	    	'8'=>sprintf("%s %s", 538, 1710),
	    	'9'=>sprintf("%s %s", 755, 1710)
	    );
	    system('adb shell input tap ' . $number[$num]);
	}

	screencap();
	$tag = array(
		array('1-1',9, 189),
		array('1-2',126, 189),
		array('1-3',243, 189),
		array('1-4',366, 189),
		array('1-5',483, 189),
		array('1-6',600, 189),
		array('1-7',723, 189),
		array('1-8',840, 189),
		array('1-9',957, 189),

		array('2-1',9, 306),
		array('2-2',126, 306),
		array('2-3',243, 306),
		array('2-4',366, 306),
		array('2-5',483, 306),
		array('2-6',600, 306),
		array('2-7',723, 306),
		array('2-8',840, 306),
		array('2-9',957, 306),

		array('3-1',9, 423),
		array('3-2',126, 423),
		array('3-3',243, 423),
		array('3-4',366, 423),
		array('3-5',483, 423),
		array('3-6',600, 423),
		array('3-7',723, 423),
		array('3-8',840, 423),
		array('3-9',957, 423),

		array('4-1',9, 546),
		array('4-2',126, 546),
		array('4-3',243, 546),
		array('4-4',366, 546),
		array('4-5',483, 546),
		array('4-6',600, 546),
		array('4-7',723, 546),
		array('4-8',840, 546),
		array('4-9',957, 546),

		array('5-1',9, 663),
		array('5-2',126, 663),
		array('5-3',243, 663),
		array('5-4',366, 663),
		array('5-5',483, 663),
		array('5-6',600, 663),
		array('5-7',723, 663),
		array('5-8',840, 663),
		array('5-9',957, 663),

		array('6-1',9, 780),
		array('6-2',126, 780),
		array('6-3',243, 780),
		array('6-4',366, 780),
		array('6-5',483, 780),
		array('6-6',600, 780),
		array('6-7',723, 780),
		array('6-8',840, 780),
		array('6-9',957, 780),

		array('7-1',9, 903),
		array('7-2',126, 903),
		array('7-3',243, 903),
		array('7-4',366, 903),
		array('7-5',483, 903),
		array('7-6',600, 903),
		array('7-7',723, 903),
		array('7-8',840, 903),
		array('7-9',957, 903),

		array('8-1',9, 1020),
		array('8-2',126, 1020),
		array('8-3',243, 1020),
		array('8-4',366, 1020),
		array('8-5',483, 1020),
		array('8-6',600, 1020),
		array('8-7',723, 1020),
		array('8-8',840, 1020),
		array('8-9',957, 1020),

		array('9-1',9, 1137),
		array('9-2',126, 1137),
		array('9-3',243, 1137),
		array('9-4',366, 1137),
		array('9-5',483, 1137),
		array('9-6',600, 1137),
		array('9-7',723, 1137),
		array('9-8',840, 1137),
		array('9-9',957, 1137)
	);

	$sudoku_arr = new_cut($tag);
	$new_arr = $sudoku_arr;
	$sudoku = new Sudoku();
	$sudoku->calc($sudoku_arr);
	class Sudoku {
	    var $matrix;
	    function __construct($arr = null) {
	        if ($arr == null) {
	            $this->clear();
	        } else {
	            $this->matrix = $arr;
	        }
	    }
	    function clear() {
	        for($i=0; $i<9; $i++) {
	            for($j=0; $j<9; $j++) {
	                $this->matrix[$i][$j] = array();
	                for ($k = 1; $k <= 9; $k++) {
	                    $this->matrix[$i][$j][$k] = $k;
	                }
	            }
	        }
	    }
	    function setCell($row, $col, $value){
	        $this->matrix[$row][$col] = array($value => $value);
	        //row
	        for($i = 0; $i < 9; $i++){
	            if($i != $col){
	                if(! $this->removeValue($row, $i, $value)) {
	                    return false;
	                }
	            }
	        }
	        //col
	        for($i = 0; $i < 9; $i++){
	            if($i != $row){
	                if(! $this->removeValue($i, $col, $value)) {
	                    return false;
	                }
	            }
	        }
	        //square
	        $rs=intval($row / 3) * 3;
	        $cs=intval($col / 3) * 3;
	        for($i = $rs; $i < $rs + 3; $i++){
	            for($j = $cs; $j < $cs + 3; $j++){
	                if($i != $row && $j != $col){
	                    if(! $this->removeValue($i, $j, $value))
	                        return false;
	                }
	            }
	        }
	        return true;
	    }
	    function removeValue($row, $col, $value) {
	        $count = count($this->matrix[$row][$col]);
	        if($count == 1){
	            $ret = !isset($this->matrix[$row][$col][$value]);
	            return $ret;
	        }
	        if (isset($this->matrix[$row][$col][$value])) {
	            unset($this->matrix[$row][$col][$value]);
	            if($count - 1 == 1) {
	                return $this->setCell($row, $col, current($this->matrix[$row][$col]));
	            }
	        }
	        return true;
	    }
	    function set($arr) {
	        for ($i = 0; $i < 9; $i++) {
	            for ($j = 0; $j < 9; $j++) {
	                if ($arr[$i][$j] > 0) {
	                    $this->setCell($i, $j, $arr[$i][$j]);
	                }
	            }
	        }
	    }
	    function dump() {
	        for($i = 0; $i < 9; $i++){
	            for($j = 0; $j < 9; $j++){
	                $c = count($this->matrix[$i][$j]);
	                if($c == 1){
	                    echo " ".current($this->matrix[$i][$j])." ";
	                } else {
	                    echo "(".$c.")";
	                }
	            }
	            echo "<br>";
	        }
	        echo "<br>";
	    }
	    function result() {
	        global $new_arr;
	        for($i = 0; $i < 9; $i++){
	            for($j = 0; $j < 9; $j++){
	                $c = count($this->matrix[$i][$j]);
	                if($c == 1){
	                    $new_arr[$i][$j] = current($this->matrix[$i][$j]);
	                } else {
	                    $new_arr[$i][$j] = $c;
	                }
	            }
	        }
	    }
	    function dumpAll() {
	        for($i = 0; $i < 9; $i++){
	            for($j = 0; $j < 9; $j++){
	                echo implode('', $this->matrix[$i][$j]), "&nbsp;&nbsp;";
	            }
	            echo "<br>";
	        }
	        echo "<br>";
	    }
	    function calc($data) {
	        $this->clear();
	        $this->set($data);
	        $this->_calc();
	        $this->result();
	    }
	    function _calc() {
	        for($i = 0; $i < 9; $i++){
	            for($j = 0; $j < 9; $j++){
	                if(count($this->matrix[$i][$j]) == 1) {
	                    continue;
	                }
	                foreach($this->matrix[$i][$j] as $v){
	                    $flag = false;
	                    $t = new Sudoku($this->matrix);
	                    if(!$t->setCell($i, $j, $v)){
	                        continue;
	                    }
	                    if(!$t->_calc()){
	                        continue;
	                    }
	                    $this->matrix = $t->matrix;
	                    return true;
	                }
	                return false;
	            }
	        }
	        return true;
	    }
	}

	$sum = 0;
    for ($i=0;$i<9;$i++){
        for ($j=0;$j<9;$j++){
            if($sudoku_arr[$i][$j]==0){
            	var_dump(time());
                press($tag[$sum],$new_arr[$i][$j]);
                var_dump(time());
            }
            $sum = $sum + 1;
        }
    }
 ?>
