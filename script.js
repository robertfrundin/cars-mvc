async function addFormHandlers() {
  let editButtons = [...document.getElementsByClassName('car-buttons-edit')]
  editButtons.forEach((el) =>
    el.addEventListener('click', () => {
      document.getElementById(el.dataset.id).classList.remove('hide')
    })
  )
  let closeButtons = [...document.getElementsByClassName('form-actions-close')]
  closeButtons.forEach((el) =>
    el.addEventListener('click', () => {
      document.getElementById(el.dataset.id).classList.add('hide')
    })
  )
  let deleteButtons = [...document.getElementsByClassName('car-buttons-delete')]
  deleteButtons.forEach((el) =>
    el.addEventListener('click', async (event) => {
      event.preventDefault()
      fetch('http://cars/controller.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8',
        },
        body: new URLSearchParams({
          type: 'delete',
          id: el.dataset.id,
        }),
      })
    })
  )
}

addFormHandlers()
