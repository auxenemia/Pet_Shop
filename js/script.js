var xmlhttp,xo,username,customer;
xmlhttp = GetXmlHttpObject();
xmlhttp.onreadystatechange = function() {
	if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		document.getElementById("content").innerHTML = xmlhttp.responseText;
	}
}
xmlhttp.open("GET","./ajax/ajax.php",true);
xmlhttp.send();
function GetXmlHttpObject(){
	if(window.XMLHttpRequest){return new XMLHttpRequest();}	// code for IE7+, Firefox, Chrome, Opera, Safari
	if(window.ActiveXObject){return new ActiveXObject("Microsoft.XMLHTTP");}	// code for IE6, IE5
	return null;
}
function login(x){
	xo = x;
	xmlhttp = GetXmlHttpObject();
	xmlhttp.onreadystatechange = function() {
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("content").innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","./ajax/ajax.php?login",true);
	xmlhttp.send();
}
function validate(){
	error 	 = document.getElementById("error");
	username = document.getElementById("username").value;
	password = document.getElementById("password").value;
	if(username == "" || password == ""){
		error.className = error.className.replace("none", "");
	}else{
		if(xo == 'a'){stock();}
		else{cashier();}
	}
}
function stock(){
	xmlhttp = GetXmlHttpObject();
	xmlhttp.onreadystatechange = function() {
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("content").innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","./ajax/ajax.php?stock",true);
	xmlhttp.send();
}
function cashier(){
	date = new Date;
	xmlhttp = GetXmlHttpObject();
	xmlhttp.onreadystatechange = function() {
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("content").innerHTML = xmlhttp.responseText;
			document.getElementById("kasir").value = username;
			document.getElementById("transaksi").value = date.getFullYear()+''+(date.getMonth()+1)+''+date.getDate()+'00'+Math.floor((Math.random() * 999) + 1);
			document.getElementById("konsumen").value = Math.floor((Math.random() * 99999) + 1);
			datetime();
		}
	}
	xmlhttp.open("GET","./ajax/ajax.php?cashier="+username,true);
	xmlhttp.send();
}
function datetime(){
	date = new Date;
	year = date.getFullYear();
	month = date.getMonth();
	months = new Array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
	days = new Array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');	
	d = date.getDate();
	day = date.getDay();
	h = date.getHours();
	if(h<10){h = "0"+h;}
	m = date.getMinutes();
	if(m<10){m = "0"+m;}
	s = date.getSeconds();
	if(s<10){s = "0"+s;}
	result = ''+days[day]+', '+d+'-'+months[month]+'-'+year+' '+h+':'+m+':'+s;
	document.getElementById("datetime").value = result;
	setTimeout('datetime();','1000');
	return true;
}
function updateTotal(){
	xmlhttp = GetXmlHttpObject();
	xmlhttp.onreadystatechange = function() {
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			if(xmlhttp.responseText != ""){
				document.getElementById("total").innerHTML = xmlhttp.responseText;
				document.getElementById("total2").innerHTML = xmlhttp.responseText;
			}
		}
	}
	xmlhttp.open("GET","./ajax/ajax.php?total",true);
	xmlhttp.send();
}
function addItem(){
	xmlhttp = GetXmlHttpObject();
	xmlhttp.onreadystatechange = function() {
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("table").innerHTML = xmlhttp.responseText;
			document.getElementById("jumlah").value = 1;
			document.getElementById("kode").value = "";
			updateTotal();
		}
	}
	xmlhttp.open("GET","./ajax/ajax.php?item="+document.getElementById("kode").value+"&jumlah="+document.getElementById("jumlah").value,true);
	xmlhttp.send();
}
function ticket(){
	date = new Date;
	xmlhttp = GetXmlHttpObject();
	xmlhttp.onreadystatechange = function() {
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("pa").innerHTML = document.getElementById("transaksi").value;
			document.getElementById("pb").innerHTML = document.getElementById("konsumen").value;
			document.getElementById("pc").innerHTML = document.getElementById("nama").value;
			document.getElementById("pd").innerHTML = document.getElementById("alamat").value;
			document.getElementById("pe").innerHTML = document.getElementById("phone").value;
			document.getElementById("pf").innerHTML = document.getElementById("kasir").value;
			document.getElementById("pg").innerHTML = xmlhttp.responseText;
			document.getElementById("ph").innerHTML = document.getElementById("total2").innerHTML;
			document.getElementById("pi").innerHTML = document.getElementById("tunai").value;
			document.getElementById("pj").innerHTML = document.getElementById("kembali").innerHTML;
			document.getElementById("table").innerHTML = "";
			document.getElementById("total").innerHTML = 0;
			document.getElementById("total2").innerHTML = 0;
			document.getElementById("jumlah").value = 1;
			document.getElementById("transaksi").value = date.getFullYear()+''+(date.getMonth()+1)+''+date.getDate()+'00'+Math.floor((Math.random() * 999) + 1);
			document.getElementById("konsumen").value = Math.floor((Math.random() * 99999) + 1);
			document.getElementById("phone").value = "";
			document.getElementById("nama").value = "";
			document.getElementById("alamat").value = "";
		}
	}
	xmlhttp.open("GET","./ajax/ajax.php?ticket",true);
	xmlhttp.send();
}
function bayar(x){
	document.getElementById("kembali").innerHTML = x-(document.getElementById("total2").innerHTML);
}
function insert(){
	xmlhttp = GetXmlHttpObject();
	xmlhttp.onreadystatechange = function() {
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			stock();
		}
	}
	a = document.getElementById("a").value;
	b = document.getElementById("b").value;
	c = document.getElementById("c").value;
	d = document.getElementById("d").value;
	e = document.getElementById("e").value;
	f = document.getElementById("f").value;
	xmlhttp.open("GET","./ajax/ajax.php?insert="+a+"&a="+a+"&b="+b+"&c="+c+"&d="+d+"&e="+e+"&f="+f,true);
	xmlhttp.send();
}
function update(x){
	xmlhttp = GetXmlHttpObject();
	xmlhttp.onreadystatechange = function() {
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			stock();
		}
	}
	a = document.getElementById("a"+x).value;
	b = document.getElementById("b"+x).value;
	c = document.getElementById("c"+x).value;
	d = document.getElementById("d"+x).value;
	e = document.getElementById("e"+x).value;
	f = document.getElementById("f"+x).value;
	xmlhttp.open("GET","./ajax/ajax.php?update="+a+"&a="+a+"&b="+b+"&c="+c+"&d="+d+"&e="+e+"&f="+f,true);
	xmlhttp.send();
}
function delet(x){
	xmlhttp = GetXmlHttpObject();
	xmlhttp.onreadystatechange = function() {
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			stock();
		}
	}
	a = document.getElementById("a"+x).value;
	xmlhttp.open("GET","./ajax/ajax.php?delet="+a,true);
	xmlhttp.send();
}
