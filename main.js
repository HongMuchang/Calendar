let msg = "万年カレンダー";

flog = 0;
count = 0;
num = 0;
function en() {
  //-------文字を1文字ずつ表示[flog=0]---------
  if (flog == 0) {
    //値を取得して代入
    document.myForm.myFormMes.value = msg.substring(0, count);
    //もし全て表示できたら[flog=1],cntの初期化

    //countとmsgが同じ文字数になるまで繰り返す(全文字表示)
    if (count <= msg.length) {
      count = count + 1;
      flog = 0;
    } else {
      flog = 1;
    }
  }
  //-------点滅[flog=1]------------------
  else if (flog == 1) {
    //5回点滅するまで繰り返す。
    if (num <= 5) {
      document.myForm.myFormMes.value = msg;
      num++;
      flog = 2;
    }
  }
  //-------点滅消去[flog=2]------------------
  else {
    document.myForm.myFormMes.value = "";
    flog = 1;
    if (num > 5) {
      document.myForm.myFormMes.value = "むちゃん";
    }
  }
}

setInterval("en()", 200);
