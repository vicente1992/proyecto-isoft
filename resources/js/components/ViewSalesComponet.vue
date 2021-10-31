<template>
  <div class="row justify-content-center">
    <div class="col-10">
      <div class="card top-selling">
        <div class="card-body pb-0">
          <h5 class="card-title">Ventas realizadas</h5>
          <table class="table table-borderless" v-if="listSales.length > 0">
            <thead>
              <tr>
                <th scope="col">Cliente</th>
                <th scope="col">identificación</th>
                <th scope="col">Vendedor</th>
                <th scope="col">Monto toal</th>
                <th scope="col">Fecha</th>
                <th scope="col">Detalle</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="sale in listSales" :key="sale.id">
                <td>{{ sale.customer }}</td>
                <td>{{ sale.id_customer }}</td>
                <td>{{ sale.sellerName }}</td>
                <td>{{ sale.amount }}</td>
                <td>{{ sale.created_at }}</td>
                <td>
                  <a
                    @click="getDetial(sale)"
                    class="btn btn-secondary btn-xs"
                    data-bs-toggle="modal"
                    data-bs-target="#largeModal"
                  >
                    <i class="fas fa-eye"></i
                  ></a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <!-- Large Modal -->
      <div class="modal fade" id="largeModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title fw-bold">Detalle de la venta</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
                @click="totalAmount = 0"
              ></button>
            </div>
            <div class="modal-body">
              <div class="d-flex justify-content-between my-3">
                <span class="fw-bold"> Vendedor: {{ sale.sellerName }} </span>
                <span class="fw-bold"> Cliente: {{ sale.customer }}</span>
              </div>
              <table class="table table-borderless">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Precio venta</th>
                    <th scope="col">descuento</th>
                    <th scope="col">subtotal</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(item, index) in sale.order" :key="item.id">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.name }}</td>
                    <td>{{ item.quantity }}</td>
                    <td>{{ item.price }}</td>
                    <td>{{ item.discount }}</td>
                    <td>{{ item.amount }}</td>
                  </tr>
                </tbody>
              </table>
              <div class="d-flex justify-content-between">
                <div></div>
                <span class="fw-bold fs-3"> Total: $ {{ totalAmount }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>    
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      listSales: [],
      sale: {
        order: [],
      },
      totalAmount: 0,
    };
  },
  mounted() {
    this.getSales();
  },
  methods: {
    async getSales() {
      try {
        const response = await axios.get(
          "http://localhost:8000/api/sales/list"
        );
        const { sales } = response.data;
        this.listSales = sales.data;       
      } catch (error) {
        console.log(error);
      }
    },
    getDetial(sale = {}) {
      this.sale = sale;
      this.getTotal(this.sale.order);
    },
    getTotal(orders = []) {
      orders.map((order) => (this.totalAmount += order.amount));
    },
  },
};
</script>