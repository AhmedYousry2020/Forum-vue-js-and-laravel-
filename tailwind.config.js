module.exports = {
  purge: [
    './resources/views/**/*.blade.php',
    './resources/css/**/*.css',
  ],
  theme: {
    extend: {
        colors:{
            mainColor:"#89C9C9",
            btnBlueColor:"#0662FF"
        },
        fontFamily:{
            sans:['Ubuntu','Montserrat'],

        }
    }
  },
  variants: {},
  plugins: [
    require('@tailwindcss/custom-forms')
  ]
}
