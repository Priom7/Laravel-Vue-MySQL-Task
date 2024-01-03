<template>
    <div class="card">
        <div class="card-header">
            <h4 class="text-center">
                <i class="fa fa-globe text-info" aria-hidden="true"> </i>
                Employee Entry
            </h4>
        </div>

        <div class="card-body">
            <DynamicForm
                :formFields="formFields"
                :formData="formData"
                :errors="errors"
                @field-errors="handleFieldErrors"
                ref="childComponentRef"
            />
        </div>
        <div class="card-footer">
            <button
                :disabled="Object.values(errors).some((error) => error !== '')"
                v-if="is_update == 0"
                @click="saveEmployee"
                class="btn btn-info float-right"
            >
                Save
            </button>
            <button
                :disabled="Object.values(errors).some((error) => error !== '')"
                v-if="is_update == 1"
                @click="updateEmployee"
                class="btn btn-warning float-right"
            >
                Update
            </button>
        </div>
    </div>
    <hr />
    <div class="card-header">
        <h4 class="text-center">
            <i class="fa fa-globe text-info" aria-hidden="true"> </i>
            Employee Details
        </h4>
    </div>
    <div class="card-body">
        <EmployeeTable
            :fields="tableFields"
            :items="employees"
            :editItemCallback="editEmployee"
        />
    </div>
</template>

<script>
import formData from "../../formData/EmployeeFormData";
import EmployeeTable from "../Table/DynamicTable.vue";
import DynamicForm from "../Form/DynamicForm.vue";

export default {
    components: {
        EmployeeTable,
        DynamicForm,
    },
    setup() {
        const tableFields = [
            { key: "name", label: "Name" },
            { key: "email", label: "Email" },
            { key: "phone_number", label: "Phone Number" },
            { key: "address", label: "Address" },
        ];

        return {
            tableFields,
        };
    },
    data() {
        return {
            formData,
            apiUrl: "api",
            errors: [],
            employees: [],
            is_update: 0,
            formFields: [
                {
                    name: "name",
                    label: "Employee Name",
                    type: "text",
                    required: true,
                },
                {
                    name: "email",
                    label: "Email",
                    type: "email",
                    required: true,
                },
                {
                    name: "phone_number",
                    label: "Phone Number",
                    type: "phone_number",
                    required: true,
                },
                {
                    name: "address",
                    label: "Address",
                    type: "text",
                    required: true,
                },
            ],
        };
    },
    computed: {},
    mounted() {
        this.getEmployees();
        this.formInitial();
    },
    methods: {
        getEmployees() {
            axios
                .get(`${this.apiUrl}/get-data?provider=Employee`)
                .then((response) => {
                    this.employees = response.data;
                })
                .catch((err) => {
                    showError("Opps! something went wrong.");
                });
        },
        saveEmployee() {
            this.validate(this.formFields);
            if (
                Object.values(this.formData).some(
                    (value) => value === "" || value === null
                )
            ) {
                alert("Please fill in all fields before saving.");
                return;
            } else {
                this.errors = [];
                axios
                    .post(`${this.apiUrl}/data-entry`, {
                        name: this.formData.name,
                        email: this.formData.email,
                        phone_number: this.formData.phone_number,
                        address: this.formData.address,
                        action: "EmployeeDataEntry",
                    })
                    .then((res) => {
                        this.getEmployees();
                        this.formInitial();
                        alert("Emaployee successfully added!");
                    })
                    .catch((err) => {
                        alert(err.response.data.message);
                    });
            }
        },
        updateEmployee() {
            this.is_update = 1;
            this.validate(this.formFields);
            if (
                Object.values(this.formData).some(
                    (value) => value === "" || value === null
                )
            ) {
                alert("Please fill in all fields before saving.");
                return;
            } else {
                this.errors = [];
                axios
                    .post(`${this.apiUrl}/data-entry`, {
                        id: this.formData.id,
                        name: this.formData.name,
                        email: this.formData.email,
                        phone_number: this.formData.phone_number,
                        address: this.formData.address,
                        action: "EmployeeDataUpdate",
                    })
                    .then((res) => {
                        this.getEmployees();
                        this.formInitial();
                        this.is_update = 0;
                        alert("Emaployee successfully updated!");
                    })
                    .catch((err) => {
                        alert(err.response.data.message);
                    });
            }
        },

        editEmployee(item) {
            this.is_update = 1;
            this.formData.id = item.id;
            this.formData.name = item.name;
            this.formData.phone_number = item.phone_number;
            this.formData.email = item.email;
            this.formData.address = item.address;
        },
        formInitial() {
            this.formData.name = "";
            this.formData.email = "";
            this.formData.phone_number = "";
            this.formData.address = "";
        },
        handleFieldErrors(errors) {
            this.errors = errors;
        },
        validate(fields) {
            this.$refs.childComponentRef.validateField(fields);
        },
    },
};
</script>
