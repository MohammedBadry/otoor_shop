<template>
  <div>
    <div class="form-group">
      <label for="product_type_id">{{ $t('product_types.singular') }}</label>
      <select class="custom-select" name="product_type_id" id="product_type_id" v-model="product_type_id">
        <option value="">{{ $t('product_types.select') }}</option>
        <option v-for="product_type in product_types.data"
                :value="product_type.id"
                :selected="productType == product_type.id"
        >{{ product_type.text }}
        </option>
      </select>
    </div>
    <div class="card mb-4" v-for="custom_field in custom_fields.data">
      <div class="card-header p-2">
        <strong>{{ custom_field.name }}</strong>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6" v-for="option in custom_field.options">
            <div class="row">
              <div class="col-4 col-sm-2 d-flex align-items-center">
                <div class="mt-2"
                     v-if="custom_field.options_type == 'color'"
                     :style="`width: 30px;height: 30px; background:${option.name}; border-radius: 50%`"></div>
                <strong class="mt-2" v-else>{{ option.name }}</strong>
              </div>
              <div class="col-8 col-sm-10">
                <div class="form-group">
                  <label for="product_type_id">{{ $t('field_options.attributes.additional_price') }}</label>
                  <input type="text"
                         :name="`options[${option.id}][additional_price]`"
                         :value="option.additional_price"
                         data-inputmask="'alias': 'currency'"
                         class="form-control">
                </div>
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
  props: {
    productType: {
      required: false,
    },
    productId: {
      required: false,
    },
  },
  data() {
    return {
      product_type_id: this.productType || '',
      product_types: {
        data: []
      },
      custom_fields: {
        data: []
      },
    }
  },
  created() {
    axios.get('/api/select/product_types').then(response => {
      this.product_types = response.data;
      this.getCustomFields(this.productType);
    });
  },
  watch: {
    product_type_id: {
      handler(value) {
        this.getCustomFields(value);
      }
    }
  },
  methods: {
    getCustomFields(id) {
      if (!id) {
        this.custom_fields = {data: []};
        return;
      }
      axios.get(`/api/product_types/${id}/custom_fields?product_id=${this.productId}`)
          .then(response => {
            this.custom_fields = response.data;
            setTimeout(() => {
              var Inputmask = require('inputmask').default;
              Inputmask().mask(document.querySelectorAll("input"));
            });
          });
    },
  },
}
</script>