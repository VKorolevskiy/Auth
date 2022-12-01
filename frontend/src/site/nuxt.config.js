import {Config, findEnv, loadEnv} from '@vesp/frontend'

Config.ssr = true
Config.srcDir = __dirname
Config.target = 'server'
Config.buildDir = '.nuxt/site'
Config.build = {
  babel: {
    compact: true,
  },
}
Config.generate = {
  cache: false,
  dir: 'dist/site',
  exclude: [/^\//],
}

const env = loadEnv(findEnv('../'))
Config.publicRuntimeConfig = {
  SITE_URL: env.SITE_URL,
}
Config.head.title = env.APP_NAME || 'Vesp Framework'
Config.head.link = [
  {rel: 'icon', type: 'image/x-icon', href: '/favicons/favicon.ico'},
  {rel: 'icon', type: 'image/png', sizes: '32x32', href: '/favicons/favicon-32x32.png'},
  {rel: 'icon', type: 'image/png', sizes: '16x16', href: '/favicons/favicon-16x16.png'},
  {rel: 'apple-touch-icon', sizes: '180x180', href: '/favicons/apple-touch-icon.png'},
  {rel: 'manifest', href: '/favicons/site.webmanifest'},
]

Config.buildModules = ['@nuxtjs/style-resources', '@nuxtjs/fontawesome', '@nuxtjs/eslint-module','@nuxtjs/auth-next', '@nuxtjs/i18n']
Config.modules = ['bootstrap-vue/nuxt', '@nuxtjs/axios', '@nuxtjs/pwa','@nuxtjs/toast', '@vesp/frontend']
Config.Vesp = {

}
Config.i18n.vueI18n = '@/lexicons/index.js'
Config.pwa = {
  icon: {
    fileName: 'favicons/android-chrome-512x512.png',
  },
}
Config.fontawesome = {
  addCss: false,
  component: 'fa',
  icons: {
    solid: ['faHome', 'faCartShopping', 'faMinus', 'faPlus','faEye'],
  },
}
Config.bootstrapVue.componentPlugins = [
  'LayoutPlugin',
  'NavbarPlugin',
  'ImagePlugin',
  'LinkPlugin',
  'PaginationPlugin',
  'OverlayPlugin',
  'ButtonPlugin',
  'ButtonGroupPlugin',
  'CarouselPlugin',
  'BreadcrumbPlugin',
  'NavbarPlugin',
  'ModalPlugin',
  'FormPlugin',
  'FormGroupPlugin',
  'FormInputPlugin',
  'SpinnerPlugin',
  'TabsPlugin',
]


export default Config
