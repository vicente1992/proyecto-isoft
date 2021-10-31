<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8">
        <div
          class="alert alert-primary alert-dismissible fade show"
          role="alert"
          v-if="message"
        >
          {{ message }}
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Close"
          ></button>
        </div>
        <div class="card">
          <div class="card-body">
            <!-- Serach -->
            <div class="form-group pt-4">
              <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend"
                  ><i class="fas fa-search"></i
                ></span>
                <input
                  type="text"
                  class="form-control"
                  name="email"
                  v-model="term"
                  @keyup="filterProduct"
                  placeholder="Buscar producto por nombre"
                  autocomplete="off"
                />
              </div>
            </div>
            <!-- List>Group -->
            <ul class="list-group" v-if="filteredProducts.length > 0">
              <li
                class="list-group-item list-group-item-action"
                v-for="product in filteredProducts"
                :key="product.id"
              >
                <div class="wrapper-item" @click="selectProduct(product)">
                  <div class="image-parent">
                    <img
                      :src="product.image"
                      class="img-fluid"
                      :alt="product.name"
                      width="40"
                    />
                  </div>
                  <span class="mx-4">{{ product.name }}</span>
                  <span>{{ product.price }}</span>
                </div>
              </li>
            </ul>
            <!-- Form -->
            <form @submit.prevent="addProduct(form)">
              <div class="row pt-5" v-if="product">
                <div class="col">
                  <label for="yourUsername" class="form-label">Cantidad</label>
                  <input
                    type="number"
                    v-model="form.quantityProduct"
                    class="form-control"
                    required
                  />
                </div>
                <div class="col">
                  <label for="yourUsername" class="form-label"
                    >Cantidad disponible</label
                  >
                  <input
                    type="number"
                    v-model="form.quantity"
                    class="form-control"
                    readonly
                  />
                </div>
                <div class="col">
                  <label for="yourUsername" class="form-label">Precio</label>
                  <input
                    type="number"
                    v-model="form.price"
                    class="form-control"
                    readonly
                  />
                </div>
                <div class="col">
                  <label for="yourUsername" class="form-label">Descuento</label>
                  <div class="col-sm-10">
                    <select
                      class="form-select"
                      id="floatingSelect"
                      aria-label="Floating label select example"
                      v-model="form.discount"
                    >
                      <option value="0.05">5%</option>
                      <option value="0.1">10%</option>
                      <option value="0.2">20%</option>
                      <option value="0.3">30%</option>
                      <option value="0.4">40%</option>
                      <option value="0.5">50%</option>
                    </select>
                  </div>
                </div>
                <div class="col">
                  <div class="wrapper-button">
                    <button type="submit" class="btn btn-secondary">
                      Agregar
                    </button>
                  </div>
                </div>
              </div>
            </form>
            <!-- Table -->
            <div class="mt-4" v-if="orderList.length > 0">
              <table class="table table-borderless">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Precio venta</th>
                    <th scope="col">descuento</th>
                    <th scope="col">subtotal</th>
                    <th scope="col">Acción</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(item, index) in orderList" :key="item.id">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.name }}</td>
                    <td>{{ item.quantityProduct }}</td>
                    <td>{{ item.price }}</td>
                    <td>{{ item.discount }}</td>
                    <td>{{ item.amount }}</td>
                    <td>
                      <button
                        class="btn btn-danger btn-sm"
                        @click="deleteOrder(item)"
                      >
                        <i class="far fa-trash-alt"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
              <div class="d-flex justify-content-between">
                <button class="btn btn-danger btn-sm d" @click="cancelPurchase">
                  <i class="far fa-trash-alt"></i>
                  Cancelar Venta
                </button>
                <span class="fw-bold fs-3"> Total: $ {{ orderAmount }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <form class="mt-3" @submit.prevent="saveSale(sale)">
              <h2 class="text-center mb-3">Realizar venta</h2>
              <div class="col-12">
                <label for="yourUsername" class="form-label fw-bold"
                  >Nombre del cliente</label
                >
                <input
                  type="text"
                  class="form-control"
                  v-model="sale.customer"
                />
              </div>
              <div class="col-12">
                <label for="yourUsername" class="form-label fw-bold"
                  >Identificaión del cliente</label
                >
                <input
                  type="text"
                  class="form-control"
                  v-model="sale.idCustormer"
                />
              </div>
              <div class="col-12">
                <label for="yourUsername" class="form-label fw-bold"
                  >Valor total a pagar</label
                >
                <input
                  type="text"
                  class="form-control"
                  v-model="orderAmount"
                  readonly
                />
              </div>
              <div class="col-12 mt-3 text-center">
                <button
                  :disabled="loading"
                  type="submit"
                  class="btn btn-secondary"
                >
                  {{ loading ? "Cargando..." : "Aceptar" }}
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    id: {
      type: Number,
      required: true,
    },
  },
  data() {
    return {
      term: "",
      discount: 0,
      discount: 0,
      listProducts: [],
      filteredProducts: [],
      orderList: [],
      orderAmount: 0,
      product: null,
      loading: false,
      message: "",
      form: {
        quantity: "",
        price: "",
        discount: "",
        quantityProduct: "",
      },
      sale: {
        customer: "",
        idCustormer: "",
      },
    };
  },
  mounted() {
    this.getProducts();
  },
  // computed: { },
  methods: {
    async getProducts() {
      try {
        this.filteredProducts = [];
        const response = await axios.get("http://localhost:8000/api/product");
        console.log("products...", response.data);
        this.listProducts = response.data;
      } catch (error) {
        console.log(error);
      }
    },
    filter() {
      this.filteredProducts = this.listProducts.filter((product) =>
        product.name.toLowerCase().includes(this.term.toLowerCase())
      );
    },
    filterProduct() {
      this.term.trim().length > 0 ? this.filter() : this.getProducts();
    },
    selectProduct(product) {
      this.product = product;
      this.form.quantity = product.quantity;
      this.form.price = product.price;
      this.term = "";
      this.filteredProducts = [];
    },
    addProduct(form) {
      const { quantity, price, discount = 0, quantityProduct } = form;

      if (quantityProduct > quantity)
        return alert(
          "La cantidad es mayor a la cantidad  de productos disponibles"
        );
      let amount = quantityProduct * price;
      let discountOrder = 0;

      if (discount > 0) {
        discountOrder = amount * discount;
        amount -= discountOrder;
      }
      const body = {
        quantityProduct,
        price,
        amount,
        discount: discountOrder,
        id: this.product.id,
        name: this.product.name,
      };

      this.orderList.push(body);
      this.orderAmount += amount;
      this.form = {};
      this.product = null;
    },
    cancelPurchase() {
      this.orderList = [];
      this.orderAmount = 0;
    },
    deleteOrder(product) {
      this.orderList = this.orderList.filter(
        (order) => order.id !== product.id
      );
      this.orderAmount -= product.amount;
    },
    async saveSale(sale) {
      try {
        const { customer, idCustormer } = sale;
        if (!customer || !idCustormer || this.orderAmount === 0)
          return alert("Por favor ingrse todos los campos del formulario");
        this.loading = true;
        const body = {
          customer,
          idCustormer,
          seller: this.id,
          amount: this.orderAmount,
        };
        const response = await axios.post(
          "http://localhost:8000/api/sales",
          body
        );
        const { sale: idSale } = response.data;

        await this.createOrder(idSale);
        await this.updateProduct();
        this.loading = false;
        this.orderList = [];
        this.sale = {};
        this.orderAmount = 0;
        this.message = "Venta realizada exitosamente";
      } catch (error) {
        this.loading = false;
        console.log(error);
      }
    },
    async createOrder(sale = "") {
      try {
        const orders = this.orderList.map((order) => ({
          quantity: order.quantityProduct,
          id_product: order.id,
          sale_id: sale,
          ...order,
        }));
        const response = await axios.post("http://localhost:8000/api/order", {
          orders,
        });
      } catch (error) {
        console.log(error);
      }
    },
    async updateProduct() {
      try {       
      await this.orderList.map((order) =>
          this.update(order.quantityProduct, order.id)
        );
     
      } catch (error) {
        console.log(error);
      }
    },
    async update(data, id) {
      try {
        const response = await axios.put(
          `http://localhost:8000/api/product/${id}`,
          { quantity: data }
        );
        console.log(response);
      } catch (error) {
        console.log(error);
      }
    },
  },
};
</script>

<style scoped>
.wrapper-item {
  display: flex;
  align-items: center;
  cursor: pointer;
}
.wrapper-button {
  margin-top: 30px;
}
</style>