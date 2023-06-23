import { MediaLibrary, formatLaravelErrors, sanitizeForInput, getObjPaths, getFileTypeIsAllowed, buildRuleHelpText } from '@spatie/media-library-pro-core';
import Vue from 'vue';
import get from 'lodash/get';

function normalizeComponent(template, style, script, scopeId, isFunctionalTemplate, moduleIdentifier
/* server only */
, shadowMode, createInjector, createInjectorSSR, createInjectorShadow) {
  if (typeof shadowMode !== 'boolean') {
    createInjectorSSR = createInjector;
    createInjector = shadowMode;
    shadowMode = false;
  } // Vue.extend constructor export interop.


  var options = typeof script === 'function' ? script.options : script; // render functions

  if (template && template.render) {
    options.render = template.render;
    options.staticRenderFns = template.staticRenderFns;
    options._compiled = true; // functional template

    if (isFunctionalTemplate) {
      options.functional = true;
    }
  } // scopedId


  if (scopeId) {
    options._scopeId = scopeId;
  }

  var hook;

  if (moduleIdentifier) {
    // server build
    hook = function hook(context) {
      // 2.3 injection
      context = context || // cached call
      this.$vnode && this.$vnode.ssrContext || // stateful
      this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext; // functional
      // 2.2 with runInNewContext: true

      if (!context && typeof __VUE_SSR_CONTEXT__ !== 'undefined') {
        context = __VUE_SSR_CONTEXT__;
      } // inject component styles


      if (style) {
        style.call(this, createInjectorSSR(context));
      } // register component module identifier for async chunk inference


      if (context && context._registeredComponents) {
        context._registeredComponents.add(moduleIdentifier);
      }
    }; // used by ssr in case component is cached and beforeCreate
    // never gets called


    options._ssrRegister = hook;
  } else if (style) {
    hook = shadowMode ? function (context) {
      style.call(this, createInjectorShadow(context, this.$root.$options.shadowRoot));
    } : function (context) {
      style.call(this, createInjector(context));
    };
  }

  if (hook) {
    if (options.functional) {
      // register for functional component in vue file
      var originalRender = options.render;

      options.render = function renderWithStyleInjection(h, context) {
        hook.call(context);
        return originalRender(h, context);
      };
    } else {
      // inject component registration as beforeCreate hook
      var existing = options.beforeCreate;
      options.beforeCreate = existing ? [].concat(existing, hook) : [hook];
    }
  }

  return script;
}

/* script */

/* template */
var __vue_render__ = function () {var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;return _c('svg',{staticStyle:{"display":"none"},attrs:{"xmlns":"http://www.w3.org/2000/svg"}},[_c('symbol',{attrs:{"id":"icon-add","viewBox":"0 0 64 64"}},[_c('path',{staticClass:"media-library-icon-fill",attrs:{"d":"M46.12,30.07h-12v-12c0-1.1-0.9-2-2-2s-2,0.9-2,2v12h-12c-1.1,0-2,0.9-2,2c0,1.1,0.9,2,2,2h12v12c0,1.1,0.9,2,2,2\n                s2-0.9,2-2v-12h12c1.1,0,2-0.9,2-2C48.12,30.97,47.22,30.07,46.12,30.07z"}})]),_vm._v(" "),_c('symbol',{attrs:{"id":"icon-not-allowed","viewBox":"0 0 64 64"}},[_c('path',{staticClass:"media-library-icon-fill",attrs:{"d":"M32.12,8.07c-13.25,0-24,10.75-24,24c0,13.25,10.75,24,24,24s24-10.75,24-24C56.12,18.82,45.37,8.07,32.12,8.07z\n        M32.12,12.07c4.8,0,9.2,1.7,12.65,4.52L16.64,44.72c-2.82-3.45-4.52-7.85-4.52-12.65C12.12,21.04,21.09,12.07,32.12,12.07z\n        M32.12,52.07c-4.8,0-9.2-1.7-12.65-4.52l28.13-28.13c2.82,3.45,4.52,7.85,4.52,12.65C52.12,43.1,43.14,52.07,32.12,52.07z"}})]),_vm._v(" "),_c('symbol',{attrs:{"id":"icon-success","viewBox":"0 0 64 64"}},[_c('path',{staticClass:"media-library-icon-fill",attrs:{"d":"M28.6,45.71c-0.82,0-1.61-0.34-2.18-0.93l-9.87-10.39c-1.14-1.2-1.09-3.1,0.11-4.24c1.2-1.14,3.1-1.09,4.24,0.11l7.47,7.86\n            L42.9,19.45c1.02-1.31,2.9-1.54,4.21-0.53c1.31,1.02,1.54,2.9,0.53,4.21L30.97,44.55c-0.54,0.69-1.35,1.11-2.22,1.15\n            C28.7,45.71,28.65,45.71,28.6,45.71z"}})]),_vm._v(" "),_c('symbol',{attrs:{"id":"icon-error","viewBox":"0 0 64 64"}},[_c('path',{staticClass:"media-library-icon-fill",attrs:{"d":"M32.12,16.07c-1.66,0-3,1.34-3,3v16c0,1.66,1.34,3,3,3s3-1.34,3-3v-16C35.12,17.41,33.77,16.07,32.12,16.07z"}}),_vm._v(" "),_c('circle',{staticClass:"media-library-icon-fill",attrs:{"cx":"32.12","cy":"45.07","r":"3"}})]),_vm._v(" "),_c('symbol',{attrs:{"id":"icon-replace","viewBox":"0 0 64 64"}},[_c('path',{staticClass:"media-library-icon-fill",attrs:{"d":"M40.12,39.28H20.77l2.17-2.17c0.78-0.78,0.78-2.05,0-2.83c-0.78-0.78-2.05-0.78-2.83,0l-5.59,5.59\n                            c-0.38,0.38-0.59,0.88-0.59,1.41s0.21,1.04,0.59,1.41l5.59,5.59c0.39,0.39,0.9,0.59,1.41,0.59s1.02-0.2,1.41-0.59\n                            c0.78-0.78,0.78-2.05,0-2.83l-2.18-2.18h19.35c1.1,0,2-0.9,2-2S41.22,39.28,40.12,39.28z"}}),_vm._v(" "),_c('path',{staticClass:"media-library-icon-fill",attrs:{"d":"M49.71,23.86l-8-8c-0.78-0.78-2.05-0.78-2.83,0c-0.78,0.78-0.78,2.05,0,2.83l4.59,4.59H15.94c-1.1,0-2,0.9-2,2s0.9,2,2,2\n                h27.53l-4.59,4.59c-0.78,0.78-0.78,2.05,0,2.83c0.39,0.39,0.9,0.59,1.41,0.59s1.02-0.2,1.41-0.59l8-8\n                C50.49,25.91,50.49,24.64,49.71,23.86z"}})]),_vm._v(" "),_c('symbol',{attrs:{"id":"icon-drag","viewBox":"0 0 64 64"}},[_c('path',{staticClass:"media-library-icon-fill",attrs:{"d":"M46,30H18c-1.1,0-2,0.9-2,2c0,1.1,0.9,2,2,2h28c1.1,0,2-0.9,2-2C48,30.9,47.1,30,46,30z"}}),_vm._v(" "),_c('path',{staticClass:"media-library-icon-fill",attrs:{"d":"M46,42H18c-1.1,0-2,0.9-2,2c0,1.1,0.9,2,2,2h28c1.1,0,2-0.9,2-2C48,42.9,47.1,42,46,42z"}}),_vm._v(" "),_c('path',{staticClass:"media-library-icon-fill",attrs:{"d":"M18,22h28c1.1,0,2-0.9,2-2c0-1.1-0.9-2-2-2H18c-1.1,0-2,0.9-2,2C16,21.1,16.9,22,18,22z"}})]),_vm._v(" "),_c('symbol',{attrs:{"id":"icon-up","viewBox":"0 0 64 64"}},[_c('path',{staticClass:"media-library-icon-fill",attrs:{"d":"M41.41,27.82l-8-8c-0.78-0.78-2.05-0.78-2.83,0l-8,8c-0.78,0.78-0.78,2.05,0,2.83c0.78,0.78,2.05,0.78,2.83,0L30,26.06v16.7\n        c0,1.1,0.9,2,2,2s2-0.9,2-2v-16.7l4.59,4.59c0.39,0.39,0.9,0.59,1.41,0.59s1.02-0.2,1.41-0.59C42.2,29.87,42.2,28.6,41.41,27.82z"}})]),_vm._v(" "),_c('symbol',{attrs:{"id":"icon-down","viewBox":"0 0 64 64"}},[_c('path',{staticClass:"media-library-icon-fill",attrs:{"d":"M22.59,36.18l8,8c0.78,0.78,2.05,0.78,2.83,0l8-8c0.78-0.78,0.78-2.05,0-2.83c-0.78-0.78-2.05-0.78-2.83,0L34,37.94v-16.7\n        c0-1.1-0.9-2-2-2s-2,0.9-2,2v16.7l-4.59-4.59c-0.39-0.39-0.9-0.59-1.41-0.59s-1.02,0.2-1.41,0.59C21.8,34.13,21.8,35.4,22.59,36.18z\n        "}})]),_vm._v(" "),_c('symbol',{attrs:{"id":"icon-remove","viewBox":"0 0 64 64"}},[_c('path',{staticClass:"media-library-icon-fill",attrs:{"d":"M43.4,40.6l-8.5-8.5l8.5-8.5c0.8-0.8,0.8-2.1,0-2.8s-2.1-0.8-2.8,0l-8.5,8.5l-8.5-8.5c-0.8-0.8-2.1-0.8-2.8,0\n            c-0.8,0.8-0.8,2.1,0,2.8l8.5,8.5l-8.5,8.5c-0.8,0.8-0.8,2.1,0,2.8c0.8,0.8,2.1,0.8,2.8,0l8.5-8.5l8.5,8.5c0.8,0.8,2.1,0.8,2.8,0\n            C44.2,42.6,44.2,41.3,43.4,40.6z"}})])])};
var __vue_staticRenderFns__ = [];

  /* style */
  const __vue_inject_styles__ = undefined;
  /* scoped */
  const __vue_scope_id__ = undefined;
  /* module identifier */
  const __vue_module_identifier__ = undefined;
  /* functional template */
  const __vue_is_functional_template__ = false;
  /* style inject */
  
  /* style inject SSR */
  
  /* style inject shadow dom */
  

  
  const __vue_component__ = /*#__PURE__*/normalizeComponent(
    { render: __vue_render__, staticRenderFns: __vue_staticRenderFns__ },
    __vue_inject_styles__,
    {},
    __vue_scope_id__,
    __vue_is_functional_template__,
    __vue_module_identifier__,
    false,
    undefined,
    undefined,
    undefined
  );

//
//
//
//
//
//
var script = {
  props: {
    icon: {
      required: true,
      type: String
    }
  }
};

/* script */
const __vue_script__ = script;

/* template */
var __vue_render__$1 = function () {var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;return _c('svg',{staticClass:"media-library-icon"},[_c('use',{attrs:{"xlink:href":'#icon-' + _vm.icon}})])};
var __vue_staticRenderFns__$1 = [];

  /* style */
  const __vue_inject_styles__$1 = undefined;
  /* scoped */
  const __vue_scope_id__$1 = undefined;
  /* module identifier */
  const __vue_module_identifier__$1 = undefined;
  /* functional template */
  const __vue_is_functional_template__$1 = false;
  /* style inject */
  
  /* style inject SSR */
  
  /* style inject shadow dom */
  

  
  const __vue_component__$1 = /*#__PURE__*/normalizeComponent(
    { render: __vue_render__$1, staticRenderFns: __vue_staticRenderFns__$1 },
    __vue_inject_styles__$1,
    __vue_script__,
    __vue_scope_id__$1,
    __vue_is_functional_template__$1,
    __vue_module_identifier__$1,
    false,
    undefined,
    undefined,
    undefined
  );

var MediaLibraryRenderless = Vue.extend({
    props: {
        name: { required: false, type: String },
        routePrefix: { required: false, type: String },
        // @ts-ignore: https://github.com/vuejs/vue/issues/9357
        initialValue: { default: () => [], type: (Array | Object) },
        // @ts-ignore: https://github.com/vuejs/vue/issues/9357
        validationErrors: { default: () => ({}), type: [Object, Array] },
        validationRules: {
            required: false,
            type: Object,
        },
        translations: { required: false, type: Object },
        multiple: { default: true, type: Boolean },
        maxItems: { required: false, type: Number },
        maxSizeForPreviewInBytes: { required: false, type: Number },
        vapor: { required: false, type: Boolean },
        vaporSignedStorageUrl: { required: false, type: String },
        uploadDomain: { required: false, type: String },
        withCredentials: { required: false, type: Boolean },
        headers: { required: false, type: Object },
        beforeUpload: { default: () => { }, type: Function },
        afterUpload: { default: () => { }, type: Function },
    },
    data() {
        return {
            state: { media: [], invalidMedia: [], validationErrors: {} },
            mediaLibrary: new MediaLibrary({
                config: {
                    immutable: false,
                    routePrefix: this.routePrefix,
                    validationRules: this.validationRules,
                    maxSizeForPreviewInBytes: this.maxSizeForPreviewInBytes,
                    vapor: this.vapor,
                    vaporSignedStorageUrl: this.vaporSignedStorageUrl,
                    uploadDomain: this.uploadDomain,
                    withCredentials: this.withCredentials,
                    headers: this.headers,
                    beforeUpload: this.beforeUpload,
                    afterUpload: this.afterUpload,
                },
                initialValue: this.initialValue,
                validationErrors: this.validationErrors,
                translations: this.translations,
            }),
        };
    },
    created() {
        this.state = this.mediaLibrary.state;
        this.mediaLibrary.subscribe((newState) => {
            this.$emit('changed', newState.media.reduce((value, media) => {
                value[media.attributes.uuid] = media.attributes;
                return value;
            }, {}));
        });
    },
    watch: {
        validationErrors: {
            deep: true,
            immediate: true,
            handler: function (val) {
                this.mediaLibrary.setValidationErrors(val ? formatLaravelErrors(this.name || '', val) : {});
            },
        },
        isReadyToSubmit: {
            immediate: true,
            handler: function (val) {
                this.$emit('is-ready-to-submit-change', val);
            },
        },
        hasUploadsInProgress: {
            immediate: true,
            handler: function (val) {
                this.$emit('has-uploads-in-progress-change', val);
            },
        },
    },
    methods: {
        getImgProps(object) {
            const extension = object.attributes.name ? object.attributes.name.split('.').pop() : '';
            return {
                src: object.attributes.preview_url || object.client_preview,
                alt: object.attributes.name,
                extension,
                size: object.attributes.size,
            };
        },
        getCustomPropertyInputProps(object, propertyName) {
            return {
                value: sanitizeForInput(get(object.attributes.custom_properties, propertyName)),
            };
        },
        getCustomPropertyInputListeners(object, propertyName) {
            return {
                input: (event) => this.mediaLibrary.setCustomProperty(object.attributes.uuid, propertyName, event.target.value),
            };
        },
        getCustomPropertyInputErrors(object, propertyName) {
            return this.mediaLibrary.getCustomPropertyInputErrors(object.attributes.uuid, propertyName);
        },
        getNameInputProps(object) {
            return {
                value: get(object, 'attributes.name'),
            };
        },
        getNameInputListeners(object) {
            return {
                input: (event) => this.mediaLibrary.setProperty(object.attributes.uuid, 'attributes.name', event.target.value),
            };
        },
        getNameInputErrors(object) {
            return this.mediaLibrary.getNameInputErrors(object.attributes.uuid);
        },
        getFileInputProps() {
            const accept = this.validationRules
                ? this.validationRules.accept
                    ? this.validationRules.accept.join(',')
                    : ''
                : '';
            return { accept };
        },
        getFileInputListeners() {
            return {
                changed: (event) => this.addFiles(event.target.files),
            };
        },
        getDropZoneProps() {
            return { validationRules: this.validationRules, maxItems: this.maxItems };
        },
        getDropZoneListeners() {
            return {
                dropped: (event) => {
                    this.addFiles(event.dataTransfer.files);
                },
            };
        },
        addFiles(files) {
            if (this.multiple) {
                const end = this.maxItems ? this.maxItems - this.mediaLibrary.state.media.length : undefined;
                return Array.from(files)
                    .slice(0, end)
                    .forEach((file) => this.mediaLibrary.addFile(file));
            }
            const file = files[0];
            const existingItem = this.mediaLibrary.state.media[0];
            if (existingItem) {
                return this.mediaLibrary.replaceMedia(existingItem.attributes.uuid, file);
            }
            this.mediaLibrary.addFile(file);
        },
        removeMedia(object) {
            this.mediaLibrary.removeMedia(object.attributes.uuid);
        },
        setProperty(object, key, value) {
            this.mediaLibrary.setProperty(object.attributes.uuid, key, value);
        },
        setCustomProperty(object, key, value) {
            this.mediaLibrary.setCustomProperty(object.attributes.uuid, key, value);
        },
        setOrder(uuids) {
            this.mediaLibrary.setOrder(uuids);
        },
        replaceMedia(object, file) {
            this.mediaLibrary.replaceMedia(object.attributes.uuid, file);
        },
        addFile(file) {
            this.mediaLibrary.addFile(file);
        },
        getErrors(object) {
            return this.mediaLibrary.getErrors(object.attributes.uuid);
        },
        clearObjectErrors(object) {
            return this.mediaLibrary.clearObjectErrors(object.attributes.uuid);
        },
        clearInvalidMedia() {
            return this.mediaLibrary.clearInvalidMedia();
        },
    },
    computed: {
        hasUploadsInProgress() {
            return this.$data.mediaLibrary.hasUploadsInProgress;
        },
        isReadyToSubmit() {
            return this.$data.mediaLibrary.isReadyToSubmit;
        },
    },
    render() {
        if (this.$scopedSlots.default) {
            return this.$scopedSlots.default(this);
        }
        throw new Error('media-library-pro-vue2: no scoped slot was found.');
    },
});

//
var script$1 = {
  props: {
    name: {
      required: true,
      type: String
    },
    mediaState: {
      "default": function _default() {
        return [];
      },
      type: Array
    }
  },
  methods: {
    getObjPaths: getObjPaths,
    sanitizeForInput: sanitizeForInput,
    get: get
  }
};

/* script */
const __vue_script__$1 = script$1;

/* template */
var __vue_render__$2 = function () {var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;return _c('div',{staticStyle:{"display":"none"}},[_vm._l((_vm.mediaState),function(object,i){return [_vm._l((_vm.getObjPaths(object.attributes)),function(parameterName){return [_c('input',{key:i + parameterName,attrs:{"name":(_vm.name + "[" + (object.attributes.uuid) + "]" + parameterName),"type":"hidden"},domProps:{"value":_vm.sanitizeForInput(_vm.get(object.attributes, parameterName))}})]})]})],2)};
var __vue_staticRenderFns__$2 = [];

  /* style */
  const __vue_inject_styles__$2 = undefined;
  /* scoped */
  const __vue_scope_id__$2 = undefined;
  /* module identifier */
  const __vue_module_identifier__$2 = undefined;
  /* functional template */
  const __vue_is_functional_template__$2 = false;
  /* style inject */
  
  /* style inject SSR */
  
  /* style inject shadow dom */
  

  
  const __vue_component__$2 = /*#__PURE__*/normalizeComponent(
    { render: __vue_render__$2, staticRenderFns: __vue_staticRenderFns__$2 },
    __vue_inject_styles__$2,
    __vue_script__$1,
    __vue_scope_id__$2,
    __vue_is_functional_template__$2,
    __vue_module_identifier__$2,
    false,
    undefined,
    undefined,
    undefined
  );

//
var script$2 = {
  props: {
    validationAccept: {
      "default": function _default() {
        return [];
      },
      type: Array
    }
  },
  emits: ['clicked', 'dropped'],
  data: function data() {
    return {
      hasDragObject: false,
      isDropTarget: false,
      isValid: true
    };
  },
  mounted: function mounted() {
    document.addEventListener('dragenter', this.handleDocumentDragenter);
    document.addEventListener('dragleave', this.handleDocumentDragleave);
    document.addEventListener('dragover', this.handleDocumentDragOver);
    document.addEventListener('drop', this.handleDocumentDrop);
  },
  beforeDestroy: function beforeDestroy() {
    document.removeEventListener('dragenter', this.handleDocumentDragenter);
    document.removeEventListener('dragleave', this.handleDocumentDragleave);
    document.removeEventListener('dragover', this.handleDocumentDragOver);
    document.removeEventListener('drop', this.handleDocumentDrop);
  },
  methods: {
    handleDocumentDragenter: function handleDocumentDragenter(e) {
      e.preventDefault();
      this.testIfValid(e);
      this.hasDragObject = true;
    },
    handleDocumentDragleave: function handleDocumentDragleave(e) {
      if (!e.clientX && !e.clientY) {
        e.preventDefault();
        this.hasDragObject = false;
      }
    },
    handleDocumentDrop: function handleDocumentDrop(e) {
      e.preventDefault();
      this.hasDragObject = false;
    },
    handleDocumentDragOver: function handleDocumentDragOver(e) {
      e.preventDefault();
      var overElement = this.$el.contains(e.target);

      if (!overElement) {
        return this.isDropTarget = false;
      }

      this.isDropTarget = true;
    },
    handleDrop: function handleDrop(e) {
      e.preventDefault();

      if (e.dataTransfer.files.length) {
        this.$emit('dropped', e);
      }

      this.hasDragObject = false;
      this.isDropTarget = false;
    },
    testIfValid: function testIfValid(e) {
      var _this = this;

      if (!e.dataTransfer.items || !e.dataTransfer.items.length) {
        return this.isValid = true;
      }

      if (!this.validationAccept || !this.validationAccept.length) {
        return this.isValid = true;
      }

      this.isValid = Array.from(e.dataTransfer.items).every(function (item) {
        return getFileTypeIsAllowed(item.type, _this.validationAccept);
      });
    }
  }
};

/* script */
const __vue_script__$2 = script$2;

/* template */
var __vue_render__$3 = function () {var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;return _c('div',_vm._b({on:{"drop":_vm.handleDrop,"click":function($event){$event.stopPropagation();return _vm.$emit('clicked')}}},'div',_vm.$attrs,false),[_vm._t("default",null,null,_vm.$data)],2)};
var __vue_staticRenderFns__$3 = [];

  /* style */
  const __vue_inject_styles__$3 = undefined;
  /* scoped */
  const __vue_scope_id__$3 = undefined;
  /* module identifier */
  const __vue_module_identifier__$3 = undefined;
  /* functional template */
  const __vue_is_functional_template__$3 = false;
  /* style inject */
  
  /* style inject SSR */
  
  /* style inject shadow dom */
  

  
  const __vue_component__$3 = /*#__PURE__*/normalizeComponent(
    { render: __vue_render__$3, staticRenderFns: __vue_staticRenderFns__$3 },
    __vue_inject_styles__$3,
    __vue_script__$2,
    __vue_scope_id__$3,
    __vue_is_functional_template__$3,
    __vue_module_identifier__$3,
    false,
    undefined,
    undefined,
    undefined
  );

//
//
//
//
//
//
//
//
//
//
//
//
//
//
var script$3 = {
  props: {
    objectErrors: {
      required: true,
      type: Array
    }
  },
  data: function data() {
    return {
      window: window
    };
  },
  emits: ['back']
};

/* script */
const __vue_script__$3 = script$3;

/* template */
var __vue_render__$4 = function () {var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;return (_vm.objectErrors.length > 0)?_c('div',{staticClass:"media-library-properties"},[_c('span',{staticClass:"media-library-text-error"},_vm._l((_vm.objectErrors),function(error){return _c('span',{key:error},[_vm._v(_vm._s(error))])}),0),_vm._v(" "),_c('a',{staticClass:"media-library-text-link media-library-text-error media-library-help-clear",on:{"click":function($event){$event.stopPropagation();return _vm.$emit('back')}}},[_vm._v("\n        "+_vm._s(_vm.window.mediaLibraryTranslations.goBack)+"\n    ")])]):_vm._e()};
var __vue_staticRenderFns__$4 = [];

  /* style */
  const __vue_inject_styles__$4 = undefined;
  /* scoped */
  const __vue_scope_id__$4 = undefined;
  /* module identifier */
  const __vue_module_identifier__$4 = undefined;
  /* functional template */
  const __vue_is_functional_template__$4 = false;
  /* style inject */
  
  /* style inject SSR */
  
  /* style inject shadow dom */
  

  
  const __vue_component__$4 = /*#__PURE__*/normalizeComponent(
    { render: __vue_render__$4, staticRenderFns: __vue_staticRenderFns__$4 },
    __vue_inject_styles__$4,
    __vue_script__$3,
    __vue_scope_id__$4,
    __vue_is_functional_template__$4,
    __vue_module_identifier__$4,
    false,
    undefined,
    undefined,
    undefined
  );

//
var script$4 = {
  props: {
    title: {
      required: true,
      type: String
    }
  },
  components: {
    Icon: __vue_component__$1
  }
};

/* script */
const __vue_script__$4 = script$4;

/* template */
var __vue_render__$5 = function () {var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;return _c('li',{staticClass:"media-library-listerror"},[_c('div',{staticClass:"media-library-listerror-icon"},[_c('span',{staticClass:"media-library-button media-library-button-error"},[_c('icon',{attrs:{"icon":"error"}})],1)]),_vm._v(" "),_c('div',{staticClass:"media-library-listerror-content"},[_c('div',{staticClass:"media-library-listerror-title"},[_c('span',[_vm._v(_vm._s(_vm.title))])]),_vm._v(" "),(_vm.$slots.default)?_c('ul',{staticClass:"media-library-listerror-items"},[_vm._t("default")],2):_vm._e()])])};
var __vue_staticRenderFns__$5 = [];

  /* style */
  const __vue_inject_styles__$5 = undefined;
  /* scoped */
  const __vue_scope_id__$5 = undefined;
  /* module identifier */
  const __vue_module_identifier__$5 = undefined;
  /* functional template */
  const __vue_is_functional_template__$5 = false;
  /* style inject */
  
  /* style inject SSR */
  
  /* style inject shadow dom */
  

  
  const __vue_component__$5 = /*#__PURE__*/normalizeComponent(
    { render: __vue_render__$5, staticRenderFns: __vue_staticRenderFns__$5 },
    __vue_inject_styles__$5,
    __vue_script__$4,
    __vue_scope_id__$5,
    __vue_is_functional_template__$5,
    __vue_module_identifier__$5,
    false,
    undefined,
    undefined,
    undefined
  );

//
//
//
//
//
//
//
//
var script$5 = {
  props: {
    name: {
      "default": '',
      type: String
    },
    client_preview: {
      "default": '',
      type: String
    }
  },
  data: function data() {
    return {
      imageErrored: false
    };
  }
};

/* script */
const __vue_script__$5 = script$5;

/* template */
var __vue_render__$6 = function () {var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;return (_vm.imageErrored)?_c('span',{staticClass:"media-library-thumb-extension"},[_c('span',{staticClass:"media-library-thumb-extension-truncate"},[_vm._v(_vm._s(_vm.name.split('.').pop()))])]):_c('img',{staticClass:"media-library-thumb-img",attrs:{"src":_vm.client_preview},on:{"error":function($event){_vm.imageErrored = true;}}})};
var __vue_staticRenderFns__$6 = [];

  /* style */
  const __vue_inject_styles__$6 = undefined;
  /* scoped */
  const __vue_scope_id__$6 = undefined;
  /* module identifier */
  const __vue_module_identifier__$6 = undefined;
  /* functional template */
  const __vue_is_functional_template__$6 = false;
  /* style inject */
  
  /* style inject SSR */
  
  /* style inject shadow dom */
  

  
  const __vue_component__$6 = /*#__PURE__*/normalizeComponent(
    { render: __vue_render__$6, staticRenderFns: __vue_staticRenderFns__$6 },
    __vue_inject_styles__$6,
    __vue_script__$5,
    __vue_scope_id__$6,
    __vue_is_functional_template__$6,
    __vue_module_identifier__$6,
    false,
    undefined,
    undefined,
    undefined
  );

//
var script$6 = {
  props: {
    invalidMedia: {
      "default": function _default() {
        return {};
      },
      type: Array
    },
    topLevelErrors: {
      "default": function _default() {
        return [];
      },
      type: Array
    }
  },
  emits: ['cleared'],
  components: {
    Icon: __vue_component__$1,
    ListError: __vue_component__$5,
    ObjectPreview: __vue_component__$6
  },
  data: function data() {
    return {
      erroredImages: [],
      hideTopLevelErrors: false
    };
  },
  watch: {
    topLevelErrors: {
      deep: true,
      immediate: true,
      handler: function handler(val) {
        if (val) {
          this.hideTopLevelErrors = false;
        }
      }
    }
  },
  computed: {
    groupedInvalidMedia: function groupedInvalidMedia() {
      return this.invalidMedia.reduce(function (groupedInvalidMedia, invalidMediaObject) {
        var error = invalidMediaObject.errors[0];

        if (groupedInvalidMedia[error]) {
          groupedInvalidMedia[error].push(invalidMediaObject);
        } else {
          groupedInvalidMedia[error] = [invalidMediaObject];
        }

        return groupedInvalidMedia;
      }, {});
    }
  },
  methods: {
    onClearClick: function onClearClick() {
      this.hideTopLevelErrors = true;
      this.$emit('cleared');
    }
  }
};

/* script */
const __vue_script__$6 = script$6;

/* template */
var __vue_render__$7 = function () {var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;return (_vm.invalidMedia.length || (_vm.topLevelErrors.length && !_vm.hideTopLevelErrors))?_c('div',{staticClass:"media-library-listerrors"},[_c('ul',[(!_vm.hideTopLevelErrors)?_vm._l((_vm.topLevelErrors),function(error,i){return _c('list-error',{key:("top-level-" + i),attrs:{"title":error}})}):_vm._e(),_vm._v(" "),_vm._l((Object.entries(_vm.groupedInvalidMedia)),function(ref,i){
var error = ref[0];
var invalidObjects = ref[1];
return _c('list-error',{key:i,attrs:{"title":error}},_vm._l((invalidObjects),function(object,i){return _c('li',{key:i,staticClass:"media-library-listerror-item"},[_c('div',{staticClass:"media-library-listerror-thumb"},[_c('object-preview',{attrs:{"client_preview":object.client_preview || '',"name":object.attributes.name}})],1),_vm._v(" "),_c('div',{staticClass:"media-library-listerror-text"},[_vm._v(_vm._s(object.attributes.name))])])}),0)})],2),_vm._v(" "),_c('div',{staticClass:"media-library-row-remove media-library-text-error",on:{"click":function($event){$event.stopPropagation();return _vm.onClearClick($event)}}},[_c('icon',{attrs:{"icon":"remove"}})],1)]):_vm._e()};
var __vue_staticRenderFns__$7 = [];

  /* style */
  const __vue_inject_styles__$7 = undefined;
  /* scoped */
  const __vue_scope_id__$7 = undefined;
  /* module identifier */
  const __vue_module_identifier__$7 = undefined;
  /* functional template */
  const __vue_is_functional_template__$7 = false;
  /* style inject */
  
  /* style inject SSR */
  
  /* style inject shadow dom */
  

  
  const __vue_component__$7 = /*#__PURE__*/normalizeComponent(
    { render: __vue_render__$7, staticRenderFns: __vue_staticRenderFns__$7 },
    __vue_inject_styles__$7,
    __vue_script__$6,
    __vue_scope_id__$7,
    __vue_is_functional_template__$7,
    __vue_module_identifier__$7,
    false,
    undefined,
    undefined,
    undefined
  );

//
var script$7 = {
  props: {
    icon: {
      required: true,
      type: String
    },
    level: {
      "default": 'info',
      type: String
    }
  },
  components: {
    Icon: __vue_component__$1
  }
};

/* script */
const __vue_script__$7 = script$7;

/* template */
var __vue_render__$8 = function () {var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;return _c('span',{class:("media-library-button media-library-button-" + _vm.level)},[_c('icon',{attrs:{"icon":_vm.icon}})],1)};
var __vue_staticRenderFns__$8 = [];

  /* style */
  const __vue_inject_styles__$8 = undefined;
  /* scoped */
  const __vue_scope_id__$8 = undefined;
  /* module identifier */
  const __vue_module_identifier__$8 = undefined;
  /* functional template */
  const __vue_is_functional_template__$8 = false;
  /* style inject */
  
  /* style inject SSR */
  
  /* style inject shadow dom */
  

  
  const __vue_component__$8 = /*#__PURE__*/normalizeComponent(
    { render: __vue_render__$8, staticRenderFns: __vue_staticRenderFns__$8 },
    __vue_inject_styles__$8,
    __vue_script__$7,
    __vue_scope_id__$8,
    __vue_is_functional_template__$8,
    __vue_module_identifier__$8,
    false,
    undefined,
    undefined,
    undefined
  );

//
var script$8 = {
  props: {
    add: {
      "default": true,
      type: Boolean
    },
    uploadInfo: {
      required: false,
      type: Object
    },
    multiple: {
      "default": false,
      type: Boolean
    },
    validationRules: {
      required: false,
      type: Object
    },
    maxItems: {
      required: false,
      type: Number
    },
    fileTypeHelpText: {
      required: false,
      type: String
    }
  },
  emits: ['changed', 'dropped'],
  components: {
    DropZone: __vue_component__$3,
    IconButton: __vue_component__$8,
    ItemErrors: __vue_component__$4
  },
  data: function data() {
    return {
      window: window
    };
  },
  methods: {
    buildRuleHelpText: buildRuleHelpText,
    handleChange: function handleChange(event) {
      this.$emit('changed', event);
      this.$refs.fileInputRef.value = '';
    }
  }
};

/* script */
const __vue_script__$8 = script$8;

/* template */
var __vue_render__$9 = function () {var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;return _c('drop-zone',_vm._b({class:_vm.add ? 'media-library-add' : 'media-library-replace',attrs:{"validation-accept":(_vm.validationRules || {}).accept},on:{"clicked":function($event){return _vm.$refs.fileInputRef.click()},"dropped":function($event){return _vm.$emit('dropped', $event)}},scopedSlots:_vm._u([{key:"default",fn:function(ref){
var hasDragObject = ref.hasDragObject;
var isDropTarget = ref.isDropTarget;
var isValid = ref.isValid;
return _c('button',{class:['media-library-dropzone', {
            'media-library-dropzone-drag': hasDragObject && !isDropTarget,
            'media-library-dropzone-drop': hasDragObject && isDropTarget,
            'media-library-dropzone-add': _vm.add,
            'media-library-dropzone-replace': !_vm.add,
            disabled: !isValid && hasDragObject,
        }],attrs:{"type":"button"}},[_c('input',{ref:"fileInputRef",staticClass:"media-library-hidden",attrs:{"type":"file","accept":(_vm.validationRules || {}).accept ? (_vm.validationRules || {}).accept.join(',') : undefined,"multiple":_vm.multiple,"dusk":_vm.add ? 'main-uploader' : 'uploader'},on:{"change":function($event){$event.stopPropagation();return _vm.handleChange($event)}}}),_vm._v(" "),_c('div',{staticClass:"media-library-placeholder"},[(isValid || !hasDragObject)?_c('icon-button',{attrs:{"level":"info","icon":_vm.add ? 'add' : 'replace'}}):_c('icon-button',{attrs:{"level":"warning","icon":"not-allowed"}}),_vm._v(" "),(_vm.uploadInfo)?_c('div',{class:("media-library-progress-wrap " + (_vm.uploadInfo.hasFinishedUploading ? '' : 'media-library-progress-wrap-loading'))},[_c('progress',{staticClass:"media-library-progress",attrs:{"max":"100"},domProps:{"value":_vm.uploadInfo.uploadProgress}})]):_vm._e()],1),_vm._v(" "),(_vm.add)?_c('div',{staticClass:"media-library-help"},[(isValid && hasDragObject)?[(isDropTarget)?_c('span',[_vm._v(_vm._s(_vm.window.mediaLibraryTranslations.dropFile))]):_c('span',[_vm._v(_vm._s(_vm.window.mediaLibraryTranslations.dragHere))])]:_c('span',[_vm._v(_vm._s(_vm.buildRuleHelpText({ validationRules: _vm.validationRules, maxItems: _vm.maxItems, fileTypeHelpText: _vm.fileTypeHelpText })))])],2):_vm._e()])}}])},'drop-zone',_vm.$attrs,false))};
var __vue_staticRenderFns__$9 = [];

  /* style */
  const __vue_inject_styles__$9 = undefined;
  /* scoped */
  const __vue_scope_id__$9 = undefined;
  /* module identifier */
  const __vue_module_identifier__$9 = undefined;
  /* functional template */
  const __vue_is_functional_template__$9 = false;
  /* style inject */
  
  /* style inject SSR */
  
  /* style inject shadow dom */
  

  
  const __vue_component__$9 = /*#__PURE__*/normalizeComponent(
    { render: __vue_render__$9, staticRenderFns: __vue_staticRenderFns__$9 },
    __vue_inject_styles__$9,
    __vue_script__$8,
    __vue_scope_id__$9,
    __vue_is_functional_template__$9,
    __vue_module_identifier__$9,
    false,
    undefined,
    undefined,
    undefined
  );

//
var script$9 = {
  props: {
    uploadInfo: {
      required: true,
      type: Object
    },
    validationRules: {
      required: false,
      type: Object
    },
    imgProps: {
      required: true,
      type: Object
    }
  },
  emits: ['replaced'],
  components: {
    Uploader: __vue_component__$9
  },
  data: function data() {
    return {
      imageErrored: false,
      oldImgSrc: this.imgProps.src
    };
  },
  watch: {
    imgProps: {
      deep: true,
      immediate: true,
      handler: function handler(val) {
        if (this.oldImgSrc != val.src) {
          this.imageErrored = false;
        }
      }
    }
  }
};

/* script */
const __vue_script__$9 = script$9;

/* template */
var __vue_render__$a = function () {var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;return _c('div',{staticClass:"media-library-thumb",attrs:{"dusk":"thumb"}},[(!!_vm.imgProps.src && !_vm.imageErrored)?_c('img',_vm._b({staticClass:"media-library-thumb-img",on:{"error":function($event){_vm.imageErrored = true;}}},'img',_vm.imgProps,false)):_c('span',{staticClass:"media-library-thumb-extension"},[_c('span',{staticClass:"media-library-thumb-extension-truncate"},[_vm._v(_vm._s(_vm.imgProps.extension))])]),_vm._v(" "),_c('uploader',_vm._b({attrs:{"validation-rules":_vm.validationRules,"add":false,"multiple":false,"upload-info":_vm.uploadInfo},on:{"dropped":function($event){return _vm.$emit('replaced', $event.dataTransfer.files[0])},"changed":function($event){return _vm.$emit('replaced', $event.target.files[0])}}},'uploader',_vm.$attrs,false))],1)};
var __vue_staticRenderFns__$a = [];

  /* style */
  const __vue_inject_styles__$a = undefined;
  /* scoped */
  const __vue_scope_id__$a = undefined;
  /* module identifier */
  const __vue_module_identifier__$a = undefined;
  /* functional template */
  const __vue_is_functional_template__$a = false;
  /* style inject */
  
  /* style inject SSR */
  
  /* style inject shadow dom */
  

  
  const __vue_component__$a = /*#__PURE__*/normalizeComponent(
    { render: __vue_render__$a, staticRenderFns: __vue_staticRenderFns__$a },
    __vue_inject_styles__$a,
    __vue_script__$9,
    __vue_scope_id__$a,
    __vue_is_functional_template__$a,
    __vue_module_identifier__$a,
    false,
    undefined,
    undefined,
    undefined
  );

export { __vue_component__$3 as DropZone, __vue_component__$2 as HiddenFields, __vue_component__$1 as Icon, __vue_component__ as Icons, __vue_component__$4 as ItemErrors, __vue_component__$7 as ListErrors, MediaLibraryRenderless, __vue_component__$a as Thumb, __vue_component__$9 as Uploader };
