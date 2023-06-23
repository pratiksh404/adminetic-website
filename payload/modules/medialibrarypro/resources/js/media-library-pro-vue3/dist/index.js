import { openBlock, createBlock, createVNode, defineComponent, Fragment, renderList, mergeProps, withModifiers, renderSlot, toDisplayString, createCommentVNode, resolveComponent, withCtx } from 'vue';
import { MediaLibrary, formatLaravelErrors, sanitizeForInput, getObjPaths, getFileTypeIsAllowed, buildRuleHelpText } from '@spatie/media-library-pro-core';
import get from 'lodash/get';

const _hoisted_1 = {
  xmlns: "http://www.w3.org/2000/svg",
  style: {"display":"none"}
};
const _hoisted_2 = /*#__PURE__*/createVNode("symbol", {
  id: "icon-add",
  viewBox: "0 0 64 64"
}, [
  /*#__PURE__*/createVNode("path", {
    class: "media-library-icon-fill",
    d: "M46.12,30.07h-12v-12c0-1.1-0.9-2-2-2s-2,0.9-2,2v12h-12c-1.1,0-2,0.9-2,2c0,1.1,0.9,2,2,2h12v12c0,1.1,0.9,2,2,2\n                    s2-0.9,2-2v-12h12c1.1,0,2-0.9,2-2C48.12,30.97,47.22,30.07,46.12,30.07z"
  })
], -1);
const _hoisted_3 = /*#__PURE__*/createVNode("symbol", {
  id: "icon-not-allowed",
  viewBox: "0 0 64 64"
}, [
  /*#__PURE__*/createVNode("path", {
    class: "media-library-icon-fill",
    d: "M32.12,8.07c-13.25,0-24,10.75-24,24c0,13.25,10.75,24,24,24s24-10.75,24-24C56.12,18.82,45.37,8.07,32.12,8.07z\n            M32.12,12.07c4.8,0,9.2,1.7,12.65,4.52L16.64,44.72c-2.82-3.45-4.52-7.85-4.52-12.65C12.12,21.04,21.09,12.07,32.12,12.07z\n            M32.12,52.07c-4.8,0-9.2-1.7-12.65-4.52l28.13-28.13c2.82,3.45,4.52,7.85,4.52,12.65C52.12,43.1,43.14,52.07,32.12,52.07z"
  })
], -1);
const _hoisted_4 = /*#__PURE__*/createVNode("symbol", {
  id: "icon-success",
  viewBox: "0 0 64 64"
}, [
  /*#__PURE__*/createVNode("path", {
    class: "media-library-icon-fill",
    d: "M28.6,45.71c-0.82,0-1.61-0.34-2.18-0.93l-9.87-10.39c-1.14-1.2-1.09-3.1,0.11-4.24c1.2-1.14,3.1-1.09,4.24,0.11l7.47,7.86\n                L42.9,19.45c1.02-1.31,2.9-1.54,4.21-0.53c1.31,1.02,1.54,2.9,0.53,4.21L30.97,44.55c-0.54,0.69-1.35,1.11-2.22,1.15\n                C28.7,45.71,28.65,45.71,28.6,45.71z"
  })
], -1);
const _hoisted_5 = /*#__PURE__*/createVNode("symbol", {
  id: "icon-error",
  viewBox: "0 0 64 64"
}, [
  /*#__PURE__*/createVNode("path", {
    class: "media-library-icon-fill",
    d: "M32.12,16.07c-1.66,0-3,1.34-3,3v16c0,1.66,1.34,3,3,3s3-1.34,3-3v-16C35.12,17.41,33.77,16.07,32.12,16.07z"
  }),
  /*#__PURE__*/createVNode("circle", {
    class: "media-library-icon-fill",
    cx: "32.12",
    cy: "45.07",
    r: "3"
  })
], -1);
const _hoisted_6 = /*#__PURE__*/createVNode("symbol", {
  id: "icon-replace",
  viewBox: "0 0 64 64"
}, [
  /*#__PURE__*/createVNode("path", {
    class: "media-library-icon-fill",
    d: "M40.12,39.28H20.77l2.17-2.17c0.78-0.78,0.78-2.05,0-2.83c-0.78-0.78-2.05-0.78-2.83,0l-5.59,5.59\n                                c-0.38,0.38-0.59,0.88-0.59,1.41s0.21,1.04,0.59,1.41l5.59,5.59c0.39,0.39,0.9,0.59,1.41,0.59s1.02-0.2,1.41-0.59\n                                c0.78-0.78,0.78-2.05,0-2.83l-2.18-2.18h19.35c1.1,0,2-0.9,2-2S41.22,39.28,40.12,39.28z"
  }),
  /*#__PURE__*/createVNode("path", {
    class: "media-library-icon-fill",
    d: "M49.71,23.86l-8-8c-0.78-0.78-2.05-0.78-2.83,0c-0.78,0.78-0.78,2.05,0,2.83l4.59,4.59H15.94c-1.1,0-2,0.9-2,2s0.9,2,2,2\n                    h27.53l-4.59,4.59c-0.78,0.78-0.78,2.05,0,2.83c0.39,0.39,0.9,0.59,1.41,0.59s1.02-0.2,1.41-0.59l8-8\n                    C50.49,25.91,50.49,24.64,49.71,23.86z"
  })
], -1);
const _hoisted_7 = /*#__PURE__*/createVNode("symbol", {
  id: "icon-drag",
  viewBox: "0 0 64 64"
}, [
  /*#__PURE__*/createVNode("path", {
    class: "media-library-icon-fill",
    d: "M46,30H18c-1.1,0-2,0.9-2,2c0,1.1,0.9,2,2,2h28c1.1,0,2-0.9,2-2C48,30.9,47.1,30,46,30z"
  }),
  /*#__PURE__*/createVNode("path", {
    class: "media-library-icon-fill",
    d: "M46,42H18c-1.1,0-2,0.9-2,2c0,1.1,0.9,2,2,2h28c1.1,0,2-0.9,2-2C48,42.9,47.1,42,46,42z"
  }),
  /*#__PURE__*/createVNode("path", {
    class: "media-library-icon-fill",
    d: "M18,22h28c1.1,0,2-0.9,2-2c0-1.1-0.9-2-2-2H18c-1.1,0-2,0.9-2,2C16,21.1,16.9,22,18,22z"
  })
], -1);
const _hoisted_8 = /*#__PURE__*/createVNode("symbol", {
  id: "icon-up",
  viewBox: "0 0 64 64"
}, [
  /*#__PURE__*/createVNode("path", {
    class: "media-library-icon-fill",
    d: "M41.41,27.82l-8-8c-0.78-0.78-2.05-0.78-2.83,0l-8,8c-0.78,0.78-0.78,2.05,0,2.83c0.78,0.78,2.05,0.78,2.83,0L30,26.06v16.7\n            c0,1.1,0.9,2,2,2s2-0.9,2-2v-16.7l4.59,4.59c0.39,0.39,0.9,0.59,1.41,0.59s1.02-0.2,1.41-0.59C42.2,29.87,42.2,28.6,41.41,27.82z"
  })
], -1);
const _hoisted_9 = /*#__PURE__*/createVNode("symbol", {
  id: "icon-down",
  viewBox: "0 0 64 64"
}, [
  /*#__PURE__*/createVNode("path", {
    class: "media-library-icon-fill",
    d: "M22.59,36.18l8,8c0.78,0.78,2.05,0.78,2.83,0l8-8c0.78-0.78,0.78-2.05,0-2.83c-0.78-0.78-2.05-0.78-2.83,0L34,37.94v-16.7\n            c0-1.1-0.9-2-2-2s-2,0.9-2,2v16.7l-4.59-4.59c-0.39-0.39-0.9-0.59-1.41-0.59s-1.02,0.2-1.41,0.59C21.8,34.13,21.8,35.4,22.59,36.18z\n            "
  })
], -1);
const _hoisted_10 = /*#__PURE__*/createVNode("symbol", {
  id: "icon-remove",
  viewBox: "0 0 64 64"
}, [
  /*#__PURE__*/createVNode("path", {
    class: "media-library-icon-fill",
    d: "M43.4,40.6l-8.5-8.5l8.5-8.5c0.8-0.8,0.8-2.1,0-2.8s-2.1-0.8-2.8,0l-8.5,8.5l-8.5-8.5c-0.8-0.8-2.1-0.8-2.8,0\n                c-0.8,0.8-0.8,2.1,0,2.8l8.5,8.5l-8.5,8.5c-0.8,0.8-0.8,2.1,0,2.8c0.8,0.8,2.1,0.8,2.8,0l8.5-8.5l8.5,8.5c0.8,0.8,2.1,0.8,2.8,0\n                C44.2,42.6,44.2,41.3,43.4,40.6z"
  })
], -1);

function render(_ctx, _cache) {
  return (openBlock(), createBlock("svg", _hoisted_1, [
    _hoisted_2,
    _hoisted_3,
    _hoisted_4,
    _hoisted_5,
    _hoisted_6,
    _hoisted_7,
    _hoisted_8,
    _hoisted_9,
    _hoisted_10
  ]))
}

const script = {};


script.render = render;

var script$1 = {
  props: {
    icon: {
      required: true,
      type: String
    }
  }
};

const _hoisted_1$1 = { class: "media-library-icon" };

function render$1(_ctx, _cache, $props, $setup, $data, $options) {
  return (openBlock(), createBlock("svg", _hoisted_1$1, [
    createVNode("use", {
      "xlink:href": '#icon-' + $props.icon
    }, null, 8, ["xlink:href"])
  ]))
}

script$1.render = render$1;

var MediaLibraryRenderless = defineComponent({
    props: {
        name: { required: false, type: String },
        routePrefix: { required: false, type: String },
        initialValue: { default: () => [], type: [Array, Object] },
        validationErrors: { default: () => ({}), type: [Array, Object] },
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
    emits: [
        'changed',
        'is-ready-to-submit-change',
        'has-uploads-in-progress-change',
        'isReadyToSubmitChange',
        'hasUploadsInProgressChange',
    ],
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
                dropped: (event) => this.addFiles(event.dataTransfer.files),
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
        if (this.$slots.default) {
            return this.$slots.default(this) /* as unknown */;
        }
        throw new Error('media-library-pro-vue3: no slot was found.');
    },
});

var script$2 = {
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

const _hoisted_1$2 = { style: {"display":"none"} };

function render$2(_ctx, _cache, $props, $setup, $data, $options) {
  return (openBlock(), createBlock("div", _hoisted_1$2, [
    (openBlock(true), createBlock(Fragment, null, renderList($props.mediaState, (object) => {
      return (openBlock(), createBlock(Fragment, null, [
        (openBlock(true), createBlock(Fragment, null, renderList($options.getObjPaths(object.attributes), (parameterName) => {
          return (openBlock(), createBlock("input", {
            name: `${$props.name}[${object.attributes.uuid}]${parameterName}`,
            value: $options.sanitizeForInput($options.get(object.attributes, parameterName)),
            type: "hidden"
          }, null, 8, ["name", "value"]))
        }), 256 /* UNKEYED_FRAGMENT */))
      ], 64 /* STABLE_FRAGMENT */))
    }), 256 /* UNKEYED_FRAGMENT */))
  ]))
}

script$2.render = render$2;

var script$3 = {
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
  beforeUnmount: function beforeUnmount() {
    document.removeEventListener('dragenter', this.handleDocumentDragenter);
    document.removeEventListener('dragleave', this.handleDocumentDragleave);
    document.removeEventListener('dragover', this.handleDocumentDragOver);
    document.removeEventListener('drop', this.handleDocumentDrop);
  },
  methods: {
    handleDocumentDragenter: function handleDocumentDragenter(e) {
      e.preventDefault();

      if (e.dataTransfer.dropEffect === 'move') {
        return;
      }

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

function render$3(_ctx, _cache, $props, $setup, $data, $options) {
  return (openBlock(), createBlock("div", mergeProps(_ctx.$attrs, {
    onDrop: _cache[1] || (_cache[1] = (...args) => ($options.handleDrop(...args))),
    onClick: _cache[2] || (_cache[2] = withModifiers($event => (_ctx.$emit('clicked')), ["stop"]))
  }), [
    renderSlot(_ctx.$slots, "default", _ctx.$data)
  ], 16))
}

script$3.render = render$3;

var script$4 = {
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

const _hoisted_1$3 = {
  key: 0,
  class: "media-library-properties"
};
const _hoisted_2$1 = { class: "media-library-text-error" };

function render$4(_ctx, _cache, $props, $setup, $data, $options) {
  return ($props.objectErrors.length > 0)
    ? (openBlock(), createBlock("div", _hoisted_1$3, [
        createVNode("span", _hoisted_2$1, [
          (openBlock(true), createBlock(Fragment, null, renderList($props.objectErrors, (error) => {
            return (openBlock(), createBlock("span", null, toDisplayString(error), 1))
          }), 256 /* UNKEYED_FRAGMENT */))
        ]),
        createVNode("a", {
          class: "media-library-text-link media-library-text-error media-library-help-clear",
          onClick: _cache[1] || (_cache[1] = withModifiers($event => (_ctx.$emit('back')), ["stop"]))
        }, toDisplayString(_ctx.window.mediaLibraryTranslations.goBack), 1)
      ]))
    : createCommentVNode("", true)
}

script$4.render = render$4;

var script$5 = {
  props: {
    title: {
      required: true,
      type: String
    }
  },
  components: {
    Icon: script$1
  }
};

const _hoisted_1$4 = { class: "media-library-listerror" };
const _hoisted_2$2 = { class: "media-library-listerror-icon" };
const _hoisted_3$1 = { class: "media-library-button media-library-button-error" };
const _hoisted_4$1 = { class: "media-library-listerror-content" };
const _hoisted_5$1 = { class: "media-library-listerror-title" };
const _hoisted_6$1 = {
  key: 0,
  class: "media-library-listerror-items"
};

function render$5(_ctx, _cache, $props, $setup, $data, $options) {
  const _component_icon = resolveComponent("icon");

  return (openBlock(), createBlock("li", _hoisted_1$4, [
    createVNode("div", _hoisted_2$2, [
      createVNode("span", _hoisted_3$1, [
        createVNode(_component_icon, { icon: "error" })
      ])
    ]),
    createVNode("div", _hoisted_4$1, [
      createVNode("div", _hoisted_5$1, [
        createVNode("span", null, toDisplayString($props.title), 1)
      ]),
      (_ctx.$slots.default)
        ? (openBlock(), createBlock("ul", _hoisted_6$1, [
            renderSlot(_ctx.$slots, "default")
          ]))
        : createCommentVNode("", true)
    ])
  ]))
}

script$5.render = render$5;

var script$6 = {
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

const _hoisted_1$5 = {
  key: 0,
  class: "media-library-thumb-extension"
};
const _hoisted_2$3 = { class: "media-library-thumb-extension-truncate" };

function render$6(_ctx, _cache, $props, $setup, $data, $options) {
  return (_ctx.imageErrored)
    ? (openBlock(), createBlock("span", _hoisted_1$5, [
        createVNode("span", _hoisted_2$3, toDisplayString($props.name.split('.').pop()), 1)
      ]))
    : (openBlock(), createBlock("img", {
        key: 1,
        class: "media-library-thumb-img",
        src: $props.client_preview,
        onError: _cache[1] || (_cache[1] = $event => (_ctx.imageErrored = true))
      }, null, 40, ["src"]))
}

script$6.render = render$6;

var script$7 = {
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
    Icon: script$1,
    ListError: script$5,
    ObjectPreview: script$6
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

const _hoisted_1$6 = {
  key: 0,
  class: "media-library-listerrors"
};
const _hoisted_2$4 = { class: "media-library-listerror-item" };
const _hoisted_3$2 = { class: "media-library-listerror-thumb" };
const _hoisted_4$2 = { class: "media-library-listerror-text" };

function render$7(_ctx, _cache, $props, $setup, $data, $options) {
  const _component_list_error = resolveComponent("list-error");
  const _component_object_preview = resolveComponent("object-preview");
  const _component_icon = resolveComponent("icon");

  return ($props.invalidMedia.length || ($props.topLevelErrors.length && !_ctx.hideTopLevelErrors))
    ? (openBlock(), createBlock("div", _hoisted_1$6, [
        createVNode("ul", null, [
          (!_ctx.hideTopLevelErrors)
            ? (openBlock(true), createBlock(Fragment, { key: 0 }, renderList($props.topLevelErrors, (error) => {
                return (openBlock(), createBlock(_component_list_error, { title: error }, null, 8, ["title"]))
              }), 256 /* UNKEYED_FRAGMENT */))
            : createCommentVNode("", true),
          (openBlock(true), createBlock(Fragment, null, renderList(Object.entries($options.groupedInvalidMedia), ([error, invalidObjects]) => {
            return (openBlock(), createBlock(_component_list_error, { title: error }, {
              default: withCtx(() => [
                (openBlock(true), createBlock(Fragment, null, renderList(invalidObjects, (object) => {
                  return (openBlock(), createBlock("li", _hoisted_2$4, [
                    createVNode("div", _hoisted_3$2, [
                      createVNode(_component_object_preview, {
                        client_preview: object.client_preview || '',
                        name: object.attributes.name
                      }, null, 8, ["client_preview", "name"])
                    ]),
                    createVNode("div", _hoisted_4$2, toDisplayString(object.attributes.name), 1)
                  ]))
                }), 256 /* UNKEYED_FRAGMENT */))
              ]),
              _: 2
            }, 1032, ["title"]))
          }), 256 /* UNKEYED_FRAGMENT */))
        ]),
        createVNode("div", {
          class: "media-library-row-remove media-library-text-error",
          onClick: _cache[1] || (_cache[1] = withModifiers((...args) => ($options.onClearClick(...args)), ["stop"]))
        }, [
          createVNode(_component_icon, { icon: "remove" })
        ])
      ]))
    : createCommentVNode("", true)
}

script$7.render = render$7;

var script$8 = {
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
    Icon: script$1
  }
};

function render$8(_ctx, _cache, $props, $setup, $data, $options) {
  const _component_icon = resolveComponent("icon");

  return (openBlock(), createBlock("span", {
    class: `media-library-button media-library-button-${$props.level}`
  }, [
    createVNode(_component_icon, { icon: $props.icon }, null, 8, ["icon"])
  ], 2))
}

script$8.render = render$8;

var script$9 = {
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
    DropZone: script$3,
    IconButton: script$8,
    ItemErrors: script$4
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

const _hoisted_1$7 = { class: "media-library-placeholder" };
const _hoisted_2$5 = {
  key: 0,
  class: "media-library-help"
};
const _hoisted_3$3 = { key: 0 };
const _hoisted_4$3 = { key: 1 };
const _hoisted_5$2 = { key: 1 };

function render$9(_ctx, _cache, $props, $setup, $data, $options) {
  const _component_icon_button = resolveComponent("icon-button");
  const _component_drop_zone = resolveComponent("drop-zone");

  return (openBlock(), createBlock(_component_drop_zone, mergeProps(_ctx.$attrs, {
    "validation-accept": ($props.validationRules || {}).accept,
    class: $props.add ? 'media-library-add' : 'media-library-replace',
    onClicked: _cache[2] || (_cache[2] = $event => (_ctx.$refs.fileInputRef.click())),
    onDropped: _cache[3] || (_cache[3] = $event => (_ctx.$emit('dropped', $event)))
  }), {
    default: withCtx(({ hasDragObject, isDropTarget, isValid }) => [
      createVNode("button", {
        type: "button",
        class: ['media-library-dropzone', {
                'media-library-dropzone-drag': hasDragObject && !isDropTarget,
                'media-library-dropzone-drop': hasDragObject && isDropTarget,
                'media-library-dropzone-add': $props.add,
                'media-library-dropzone-replace': !$props.add,
                disabled: !isValid && hasDragObject,
            }]
      }, [
        createVNode("input", {
          type: "file",
          accept: ($props.validationRules || {}).accept ? ($props.validationRules || {}).accept.join(',') : undefined,
          class: "media-library-hidden",
          ref: "fileInputRef",
          multiple: $props.multiple,
          onChange: _cache[1] || (_cache[1] = withModifiers((...args) => ($options.handleChange(...args)), ["stop"])),
          dusk: $props.add ? 'main-uploader' : 'uploader'
        }, null, 40, ["accept", "multiple", "dusk"]),
        createVNode("div", _hoisted_1$7, [
          (isValid || !hasDragObject)
            ? (openBlock(), createBlock(_component_icon_button, {
                key: 0,
                level: "info",
                icon: $props.add ? 'add' : 'replace'
              }, null, 8, ["icon"]))
            : (openBlock(), createBlock(_component_icon_button, {
                key: 1,
                level: "warning",
                icon: "not-allowed"
              })),
          ($props.uploadInfo)
            ? (openBlock(), createBlock("div", {
                key: 2,
                class: `media-library-progress-wrap ${
                        $props.uploadInfo.hasFinishedUploading ? '' : 'media-library-progress-wrap-loading'
                    }`
              }, [
                createVNode("progress", {
                  max: "100",
                  value: $props.uploadInfo.uploadProgress,
                  class: "media-library-progress"
                }, null, 8, ["value"])
              ], 2))
            : createCommentVNode("", true)
        ]),
        ($props.add)
          ? (openBlock(), createBlock("div", _hoisted_2$5, [
              (isValid && hasDragObject)
                ? (openBlock(), createBlock(Fragment, { key: 0 }, [
                    isDropTarget
                      ? (openBlock(), createBlock("span", _hoisted_3$3, toDisplayString(_ctx.window.mediaLibraryTranslations.dropFile), 1))
                      : (openBlock(), createBlock("span", _hoisted_4$3, toDisplayString(_ctx.window.mediaLibraryTranslations.dragHere), 1))
                  ], 64 /* STABLE_FRAGMENT */))
                : (openBlock(), createBlock("span", _hoisted_5$2, toDisplayString($options.buildRuleHelpText({ validationRules: $props.validationRules, maxItems: $props.maxItems, fileTypeHelpText: $props.fileTypeHelpText })), 1))
            ]))
          : createCommentVNode("", true)
      ], 2)
    ]),
    _: 1
  }, 16, ["validation-accept", "class"]))
}

script$9.render = render$9;

var script$a = {
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
    Uploader: script$9
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

const _hoisted_1$8 = {
  class: "media-library-thumb",
  dusk: "thumb"
};
const _hoisted_2$6 = {
  key: 1,
  class: "media-library-thumb-extension"
};
const _hoisted_3$4 = { class: "media-library-thumb-extension-truncate" };

function render$a(_ctx, _cache, $props, $setup, $data, $options) {
  const _component_uploader = resolveComponent("uploader");

  return (openBlock(), createBlock("div", _hoisted_1$8, [
    (!!$props.imgProps.src && !_ctx.imageErrored)
      ? (openBlock(), createBlock("img", mergeProps({ key: 0 }, $props.imgProps, {
          class: "media-library-thumb-img",
          onError: _cache[1] || (_cache[1] = $event => (_ctx.imageErrored = true))
        }), null, 16))
      : (openBlock(), createBlock("span", _hoisted_2$6, [
          createVNode("span", _hoisted_3$4, toDisplayString($props.imgProps.extension), 1)
        ])),
    createVNode(_component_uploader, mergeProps(_ctx.$attrs, {
      "validation-rules": $props.validationRules,
      add: false,
      multiple: false,
      "upload-info": $props.uploadInfo,
      onDropped: _cache[2] || (_cache[2] = $event => (_ctx.$emit('replaced', $event.dataTransfer.files[0]))),
      onChanged: _cache[3] || (_cache[3] = $event => (_ctx.$emit('replaced', $event.target.files[0])))
    }), null, 16, ["validation-rules", "upload-info"])
  ]))
}

script$a.render = render$a;

export { script$3 as DropZone, script$2 as HiddenFields, script$1 as Icon, script as Icons, script$4 as ItemErrors, script$7 as ListErrors, MediaLibraryRenderless, script$a as Thumb, script$9 as Uploader };
