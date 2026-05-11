async function enviar() {
  const input = document.getElementById("input");
  const mensaje = input.value;

  if (!mensaje) return;

  agregarMensaje(mensaje, "usuario");
  input.value = "";

  const res = await fetch("/preguntar", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ mensaje }),
  });

  const data = await res.json();

  agregarMensaje(data.respuesta, "ia");
}