// Date Validation Javascript
// copyright 30th October 2004, 31st December 2009 by Stephen Chapman
// http://javascript.about.com

// You have permission to copy and use this javascript provided that
// the content of the script is not changed in any way.

function valDateFmt(datefmt) {myOption = -1;
for (i=0; i<datefmt.length; i++) {if (datefmt[i].checked) {myOption = i;}}
if (myOption == -1) {alert("You must select a date format");return ' ';}
return datefmt[myOption].value;}
function valDateRng(daterng) {myOption = -1;
for (i=0; i<daterng.length; i++) {if (daterng[i].checked) {myOption = i;}}
if (myOption == -1) {alert("You must select a date range");return ' ';}
return daterng[myOption].value;}
function stripBlanks(fld) {var result = "";var c=0;for (i=0; i<fld.length; i++) {
if (fld.charAt(i) != " " || c > 0) {result += fld.charAt(i);
if (fld.charAt(i) != " ") c = result.length;}}return result.substr(0,c);}
var numb = '0123456789';
function isValid(parm,val) {if (parm == "") return true;
for (i=0; i<parm.length; i++) {if (val.indexOf(parm.charAt(i),0) == -1)
return false;}return true;}
function isNumber(parm) {return isValid(parm,numb);}
var mth = new Array(' ','january','february','march','april','may','june','july','august','september','october','november','december');
var day = new Array(31,28,31,30,31,30,31,31,30,31,30,31);
function validateDate(fld,fmt,rng) {
var dd, mm, yy;var today = new Date;var t = new Date;fld = stripBlanks(fld);
if (fld == '') return false;var d1 = fld.split('\/');
if (d1.length != 3) d1 = fld.split(' ');
if (d1.length != 3) return false;
if (fmt == 'u' || fmt == 'U') {
  dd = d1[1]; mm = d1[0]; yy = d1[2];}
else if (fmt == 'j' || fmt == 'J') {
  dd = d1[2]; mm = d1[1]; yy = d1[0];}
else if (fmt == 'w' || fmt == 'W'){
  dd = d1[0]; mm = d1[1]; yy = d1[2];}
else return false;
var n = dd.lastIndexOf('st');
if (n > -1) dd = dd.substr(0,n);
n = dd.lastIndexOf('nd');
if (n > -1) dd = dd.substr(0,n);
n = dd.lastIndexOf('rd');
if (n > -1) dd = dd.substr(0,n);
n = dd.lastIndexOf('th');
if (n > -1) dd = dd.substr(0,n);
n = dd.lastIndexOf(',');
if (n > -1) dd = dd.substr(0,n);
n = mm.lastIndexOf(',');
if (n > -1) mm = mm.substr(0,n);
if (!isNumber(dd)) return false;
if (!isNumber(yy)) return false;
if (!isNumber(mm)) {
  var nn = mm.toLowerCase();
  for (var i=1; i < 13; i++) {
    if (nn == mth[i] ||
        nn == mth[i].substr(0,3)) {mm = i; i = 13;}
  }
}
if (!isNumber(mm)) return false;
dd = parseFloat(dd); mm = parseFloat(mm); yy = parseFloat(yy);
if (yy < 100) yy += 2000;
if (yy < 1582 || yy > 4881) return false;
if (mm == 2 && (yy%400 == 0 || (yy%4 == 0 && yy%100 != 0))) day[1]=29;else day[1]=28;
if (mm < 1 || mm > 12) return false;
if (dd < 1 || dd > day[mm-1]) return false;
t.setDate(dd); t.setMonth(mm-1); t.setFullYear(yy);
if (rng == 'p' || rng == 'P') {
if (t > today) return false;
}
else if (rng == 'f' || rng == 'F') {
if (t < today) return false;
}
else if (rng != 'a' && rng != 'A') return false;
return true;
}