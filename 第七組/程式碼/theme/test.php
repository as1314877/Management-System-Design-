<HTML>
<HEAD><TITLE>動態下拉式選單 (二階層):</Title></Head>


<FORM Name="myForm">

第一個下拉式選單名稱為 color
:

<SELECT Name="color" OnChange="Buildkey(this.selectedIndex);">
<OPTION Value="紅色">紅色
<OPTION Value="黃色">黃色
<OPTION Value="綠色">綠色
</Select>

<BR>
第二個下拉式選單名稱為 fruit
:

<SELECT Name="fruit">
<option>蘋果</option>
<option> 蓮霧</option>
<option>李子</option>
</Select>


</Form>
</Body>
</Html>

<SCRIPT Language="JavaScript">
key=new Array(3);
key[0]=new Array(3);
key[1]=new Array(2);
key[2]=new Array(3);

key[0][0]="蘋果";
key[0][1]="蓮霧";
key[0] [2]="李子";

key[1][0]="柳丁";
key[1][1]="葡萄柚";

key[2][0]="芭樂";
key[2][1]="西瓜";
key[2] [2]="棗子";

function Buildkey(num)
{
  document.myForm.fruit.selectedIndex=0;
  for(ctr=0;ctr<key[num].length;ctr++){
    document.myForm.fruit.options[ctr]=new Option(key[num][ctr],key[num][ctr]);
  }
 document.myForm.fruit.length=key[num].length;
}


</Script> 