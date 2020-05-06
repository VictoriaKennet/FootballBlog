export default {
    data() {
        return {
            loginEmailRules: [
                v => !!v || 'Обов\'язкове поле',
                v => /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(v) || 'Не коректний Email'
            ],
            loginPasswordRules: [
                v => !!v || 'Обов\'язкове поле',
                v => String(v).length >= 8 || 'Не менше 8 символів'
            ],
            passwordRules: [
                v => String(v).length >= 8 || 'Не менше 8 символів'
            ],
            repeatPasswordRules: [
                v => !!v || 'Обов\'язкове поле',
                v => v == this.password || `Не вірний пароль`
            ],
            requiredRules: [
                v => !!v || 'Обов\'язкове поле'
            ]
        }
    }
}