<template>
    <div>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th v-for="field in fields" :key="field.key">
              {{ field.label }}
            </th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(item, index) in items" :key="index">
            <td v-for="field in fields" :key="field.key">
              {{ item[field.key] }}
            </td>
            <td>
              <button @click="editItem(item)" class="btn btn-info btn-sm">
                Edit
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>

<script>
export default {
    props: {
        fields: {
            type: Array,
            required: true,
        },
        items: {
            type: Array,
            required: true,
        },
        editItemCallback: {
            type: Function,
            required: false,
        },
    },
    methods: {
        editItem(item) {
            if (this.editItemCallback) {
                this.editItemCallback(item);
            }
        },
    },
};
</script>
