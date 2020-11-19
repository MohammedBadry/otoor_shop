<template>
  <div class="row">
    <div class="col">
      <table class="table table-bordered align-items-center table-sm">
        <thead class="thead-light">
        <tr>
          <th>#</th>
          <th>{{ $t('products.attributes.size') }}</th>
          <th>{{ $t('products.attributes.price') }}</th>
          <th>{{ $t('sizes.actions.delete') }}</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(field, index) in fields" :key="index">
          <td v-text="index + 1"></td>
          <td>
            <input type="text"
                   v-model="field.name"
                   :name="`sizes[${index}][name]`"
                   class="form-control">
          </td>
          <td>
            <input type="text"
                   v-model="field.price"
                   :name="`sizes[${index}][price]`"
                   class="form-control">
          </td>
          <td>
            <button type="button"
                    class="btn btn-danger btn-small"
                    @click="removeField(field)">
              <i class="fas fa-times"></i>
            </button>
          </td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
          <td colspan="4" class="text-right">
            <button type="button" class="btn btn-info" @click="addNewField()">
              <i class="fas fa-plus"></i>
            </button>
          </td>
        </tr>
        </tfoot>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  props: ['sizes'],
  data() {
    return {
      fields: [
        {
          name: '',
          price: ''
        }
      ],
    }
  },
  created() {
    if (this.sizes) {
      this.fields = this.sizes;
    }
  },
  methods: {
    addNewField() {
      this.fields.push({
        name: '',
        price: ''
      });
    },
    removeField(field) {
      this.fields = this.fields.filter(f => {
        return this.fields.indexOf(f) !== this.fields.indexOf(field);
      })
      // this.$delete(this.fields, this.fields.indexOf(field));
    }
  }
}
</script>

<style scoped>

</style>