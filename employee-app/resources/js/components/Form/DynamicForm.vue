<!-- <template>
    <div class="card-body">
        <div class="row">
            <div
                v-for="(field, index) in formFields"
                :key="index"
                class="col-md-3"
            >
                <div class="form-group">
                    <label :for="field.name">
                        {{ field.label }}
                    </label>
                    <input
                        v-if="field.type === 'text'"
                        v-model="formData[field.name]"
                        :type="field.type"
                        :class="{
                            'form-control': true,
                            'is-invalid': errors.includes(
                                `${field.label} is required`
                            ),
                        }"
                        @blur="validateField(field)"
                        :required="field.required"
                    />

                    <input
                        v-if="field.type === 'email'"
                        v-model="formData[field.name]"
                        type="email"
                        class="form-control"
                        :class="{
                            'is-invalid':
                                errors.includes(`${field.label} is required`) ||
                                errors.includes(`${field.label} is invalid`),
                        }"
                        @blur="validateField(field)"
                        :required="field.required"
                    />
                    <input
                        v-if="field.type === 'phone_number'"
                        v-model="formData[field.name]"
                        type="tel"
                        class="form-control"
                        :class="{
                            'is-invalid':
                                errors.includes(`${field.label} is required`) ||
                                errors.includes(`${field.label} is invalid`),
                        }"
                        @blur="validateField(field)"
                        :required="field.required"
                    />
                    <div
                        v-if="errors.includes(`${field.label} is required`)"
                        class="invalid-feedback"
                    >
                        {{ `${field.label} is required` }}
                    </div>
                    <div
                        v-if="errors.includes(`${field.label} is invalid`)"
                        class="invalid-feedback"
                    >
                        {{ `${field.label} is invalid` }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        formFields: {
            type: Array,
            required: true,
        },
        formData: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            errors: [],
            emailRegex: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
            phoneRegex: /^\d{11}$/,
        };
    },
    methods: {      
        validateField(field) {
            this.errors = [];
            if (!this.formData[field.name] && field.required) {
                this.errors.push(`${field.label} is required`);
            }
            if (
                field.type === "email" &&
                this.formData[field.name] &&
                !this.emailRegex.test(this.formData[field.name])
            ) {
                this.errors.push(`${field.label} is invalid`);
            }
            if (
                field.type === "phone_number" &&
                this.formData[field.name] &&
                !this.phoneRegex.test(this.formData[field.name])
            ) {
                this.errors.push(`${field.label} is invalid`);
            }
            this.$emit("field-errors", this.errors);
            console.log(this.errors);
            console.log(this.formData);
            console.log(field);
        },
    },
};
</script> -->

<template>
    <div class="card-body">
        <div class="row">
            <div
                v-for="(field, index) in formFields"
                :key="index"
                class="col-md-3"
            >
                <div class="form-group">
                    <label :for="field.name">{{ field.label }}</label>
                    <input
                        v-if="
                            field.type === 'text' ||
                            field.type === 'email' ||
                            field.type === 'phone_number'
                        "
                        v-model="formData[field.name]"
                        :type="field.type"
                        :class="{
                            'form-control': true,
                            'is-invalid': errors[field.name],
                        }"
                        @blur="validateField(field)"
                        :required="field.required"
                    />
                    <div v-if="errors[field.name]" class="invalid-feedback">
                        {{ errors[field.name] }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        formFields: {
            type: Array,
            required: true,
        },
        formData: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            errors: {},
            emailRegex: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
            phoneRegex: /^\d{11}$/,
        };
    },
    methods: {
        validateField(field) {
            this.errors[field.name] = "";

            const value = this.formData[field.name];

            if (!value && field.required) {
                this.errors[field.name] = `${field.label} is required`;
            } else if (
                field.type === "email" &&
                value &&
                !this.emailRegex.test(value)
            ) {
                this.errors[field.name] = `${field.label} is invalid`;
            } else if (
                field.type === "phone_number" &&
                value &&
                !this.phoneRegex.test(value)
            ) {
                this.errors[field.name] = `${field.label} is invalid`;
            }

            this.$emit("field-errors", this.errors);
        },
    },
};
</script>
