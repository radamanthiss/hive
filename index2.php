<html>
<head>
</head>
<body>
  <form name="versus_1.0"  action="summoner.php"  method="post" accept-charset="utf-8" enctype="multipart/form-data" onsubmit="ReadValue(this);">
    <input id="summoner" name="summoner" placeholder="Summoner Name" type="text">
    <input class="btn-buscar" type="submit" name="enviar" id="enviar" data-bs-hover-animate="pulse" value="Buscar">
    <select class="server-select" name="server" id="server" required title="Selecciona tu servidor">
      <option value="" selected="" required hidden="">servidor *</option>
      <option value="ru">RU</option>
      <option value="kr">KR</option>
      <option value="br1">BR1</option>
      <option value="oc1">OC1</option>
      <option value="jp1">JP1</option>
      <option value="na1">NA1</option>
      <option value="euw1">EUW1</option>
      <option value="tr1">TR1</option>
      <option value="la1">LA1</option>
      <option value="la2">LA2</option>
    </select>
  </form>
</body>
</html>
