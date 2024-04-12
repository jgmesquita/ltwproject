const search = document.querySelector('#search')

if (search) {
  const input = search.querySelector('input')
  input.addEventListener('input', async () => {
    const response = await fetch('/api/api_search.php?' + encodeForAjax({ q: input.value }))
    const items = await response.json()

    const tbody = search.querySelector('tbody')
    tbody.innerHTML = ''

    for (const item of items) {
      const row = document.createElement('tr')
      tbody.appendChild(row)

      const id = document.createElement('td')
      id.innerText = item.id
      row.appendChild(id)

      const ownerUser = document.createElement('td')
      ownerUser.innerText = item.ownerUser
      row.appendChild(ownerUser)

      const descriptionItem = document.createElement('td')
      descriptionItem.innerText = item.descriptionItem
      row.appendChild(descriptionItem)

      const sizeItem = document.createElement('td')
      sizeItem.innerText = item.sizeItem
      row.appendChild(sizeItem)

      const price = document.createElement('td')
      price.innerText = item.price
      row.appendChild(price)

      const brand = document.createElement('td')
      brand.innerText = item.brand
      row.appendChild(brand)

      const model = document.createElement('td')
      model.innerText = item.model
      row.appendChild(model)

      const condition = document.createElement('td')
      condition.innerText = item.condition
      row.appendChild(price)
    }
  })
}

function encodeForAjax(data) {
  return Object.keys(data).map(function (k) {
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&')
}