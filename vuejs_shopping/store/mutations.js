export const ADD_TO_CART = (state, { product, quantily }) => {
  const found = state.cart.find((item) => {
    return item.product.id === product.id
  })
  console.log('found', found)
  if (found) {
    found.quantily += quantily
    return
  }
  state.cart.push({
    product,
    quantily,
  })
}

export const UPDATE_CART = (state, { id, quantily }) => {
  const found = state.cart.find((item) => {
    return item.product.id === id
  })
  console.log(quantily)

  found.quantily = quantily
}

export const REMOVE_CART = (state, product) => {
  const index = state.cart.indexOf(product)
  state.cart.splice(index, 1)
}

export const REMOVE_CART_ITEM = (state) => {
  state.cart = []
}

