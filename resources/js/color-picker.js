import tinycolor from "tinycolor2";

const colorPicker = document.getElementById("nativeColorPicker1");
const changeColorBtn = document.getElementById("burronNativeColor");

changeColorBtn.style.backgroundColor = colorPicker.value;
colorPicker.addEventListener("input", () => {
  changeColorBtn.style.backgroundColor = colorPicker.value;
  changeColorBtn.style.color = tinycolor(colorPicker.value).brighten(30).toHexString();
});
