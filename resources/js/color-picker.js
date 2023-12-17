const colorPicker = document.getElementById("nativeColorPicker1");
const changeColorBtn = document.getElementById("burronNativeColor");

changeColorBtn.style.backgroundColor = colorPicker.value;
colorPicker.addEventListener("input", () => {
  changeColorBtn.style.backgroundColor = colorPicker.value;
});
