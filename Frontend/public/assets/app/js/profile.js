jQuery( function( $ ) {

    'use strict';

  /**
   *
   * @type {{init: init, close_modal: close_modal, form_person: form_person, install: install, parse_error: parse_error, buy_insurance: buy_insurance}}
   */

  const Profile = {
    init: function () {
            this.install  = this.install( this )
            this.showLoginDataCodeBlock = false;
        },

        /**
         * Install
         */
        install: function () {
          $(document).on('submit', '.formProfilePerson', this.form_person);


          $(document).on('change', '.auto-mark', this.get_models_by_mark);

          $(document).on('click', '.cabinet__personal-create__btn--estate', this.cities_by_country);
          $(document).on('click', '.update-building', this.cities_by_country);

          $(document).on('submit', '.formObjInsurancePerson', this.obj_insurance_form);

          $(document).on('submit', '.formObjInsuranceCar', this.obj_insurance_form);

          $(document).on('submit', '.formObjInsuranceHome', this.obj_insurance_form);

          $(document).on('submit', '.buy-insurance', this.buy_insurance);

          $(document).on('click', '.buy-insurance .cabinet__policy-item__pdf', this.download_pdf);

          $(document).on('submit', '.change-credentials-form', this.check_login_data.bind(this));

          $(document).on('hidden.bs.modal', '#modal-change-credentials', function () {
              const $this = $(this);
              Profile.showPasswordBlock($this);
              Profile.clearFields($this)
              $this.find('.error').remove();
          });

          $(document).on('hidden.bs.modal', '#modal-change-credentials', function () {
              const $this = $(this);
              Profile.showPasswordBlock($this);
              Profile.clearFields($this)
              $this.find('.error').remove();
          });
        },

      cities_by_country: function () {
          const $this = $(this)
          const url = '/api/v1/dictionaries/cities-by-country'
           $('.js-example-data-array').select2({
             selectionCssClass: 'model-select',
             dropdownCssClass: 'model-dropdown',
             placeholder: 'Города',
             ajax: {
               data: function (params) {
                 console.log(params)
                 return {
                   // code: $(`[data-id='${$this.val()}']`).data("code"),
                   code: 'UA',
                   page: params.page,
                   term: params.term,
                 }
               },
               url: url,
               dataType: 'json',
               delay: 500,
               processResults: function (data, params) {
                 params.page = params.page || 1;
                 return {
                   results: data.results,
                   pagination: {
                     more: (params.page * 30) < data.count_filtered
                   }
                 };
               }
             }
           });
        },

       get_models_by_mark: function () {
          const $this = $(this)
          const url = '/api/v1/dictionaries/autoria/models'
          $.ajax({
            beforeSend: function (xhr) {},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {'mark': $this.val()},
            method: 'GET',
            error: function (response) {
              console.dir(response)
            },
            success: function (response) {
              console.log(response)
              function appendOptions(item) {
                $(".auto-model").append(`<option value='${item.value}'>${item.name}</option>`);
              }
              if (response && response.data && response.data.length) {
                response.data.map((item) => {
                  appendOptions(item)
                })
              }
            },
            complete: function(data) {
              $this.prop("disabled",false)
              $this.find('img').addClass('d-none')
            },
            url: url
          });
        },

    /**
     *
     */
    download_pdf: function () {
        const $this = $(this)
        // console.log($this.data("id"))
        // console.log($this.find('img').removeClass('d-none'))
        const url = 'profile/download-pdf'
        $.ajax({
          beforeSend: function (xhr) {
            $this.prop("disabled",true)
            $this.find('img').removeClass('d-none')
          },
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          data: {'id': $this.data("id")},
          method: 'POST',
          error: function (response) {
            console.dir(response)
          },
          success: function (response) {
            function downloadPDF(pdf) {
              const linkSource = `data:application/pdf;base64,${pdf}`;
              const downloadLink = document.createElement("a");
              const fileName = "doc.pdf";

              downloadLink.href = linkSource;
              downloadLink.download = fileName;
              downloadLink.click();
            }
            console.log(response.receipt)
            downloadPDF(response.data)
          },
          complete: function(data) {
            $this.prop("disabled",false)
            $this.find('img').addClass('d-none')
          },
          url: url
        });
      },


      buy_insurance: function (e) {
        e.preventDefault()
        const $this = $(this),
        url = $this.attr('action');
        $.ajax({
          beforeSend: function (xhr) {},
          data: $this.serialize(),
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          method: 'POST',
          complete: function () {},
          error: function (response) {
            console.dir(response)
            Profile.parse_error($this, response);
          },
          success: function (response) {
            console.dir(response)
            if ('success' === response.status) {
              $this[0].reset()
              $this.find('.error').remove()
              $('.personCard').html(response.html).ready(function () {
                Profile.close_modal()
              })
            }
          },
          url: url
        });
      },


        /**
         * Form Person
         * @param e
         */
        obj_insurance_form: function (e) {
          e.preventDefault()
          const $this = $(this),
          url = $this.attr('action');
          console.log(url)
          $.ajax({
            beforeSend: function (xhr) {},
            data: $this.serialize(),
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            method: 'POST',
            complete: function () {},
            error: function (response) {
              console.dir(response)
              $this.find('.error').remove()
              Profile.parse_error($this, response);
            },
            success: function (response) {
              if ('success' === response.status) {
                $this[0].reset()
                $this.find('.error').remove()
                console.log(response)
                if (response.id) {
                  $(`[data-id='${response.type + response.id}']`).html(response.html).ready(function () {
                    Profile.close_modal()
                  })
                } else {
                  const d = document.createElement('div');
                  $(d).addClass('cabinet__personal-item').insertBefore(".objPerson").html(response.html).ready(function () {
                    Profile.close_modal()
                    $(`#new-${response.type}`).addClass('d-none')
                  })
                }
              }
            },
            url: url
          });
        },


        /**
         * Form Person
         * @param e
         */
        form_person: function (e) {
          e.preventDefault()
          const $this = $(this),
          url = $this.attr('action');
          $.ajax({
            beforeSend: function (xhr) {
            },
            data: $this.serialize(),
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            method: 'POST',
            complete: function () {
            },
            error: function (response) {
              console.dir(response)
              $this.find('.error').remove()
              Profile.parse_error($this, response);
            },
            success: function (response) {
              console.dir(response)
              if ('success' === response.status) {
                $this[0].reset()
                $this.find('.error').remove()
                $('.personCard').html(response.html).ready(function () {
                  Profile.close_modal()
                })
              }
            },
            url: url
          });
        },

        /**
         * Close Modal
         */
        close_modal: function ()
        {
            $('body').removeClass('is-cabinet-editable')
            $('body').find('.is-editable').removeClass('is-editable')
        },

        /**
         * Parse Error
         */
        parse_error: function (e, errors) {
          $.each(errors.responseJSON.errors, function (field_name, error) {
            e.find('.' + field_name + '-error').remove()
            let arr = ''
            $.each(error, function (err) {
              arr += '<div class="' + field_name + '-error error">' + error[err] + '</div>'
            })
            e.find('[name=' + field_name + ']').after(arr)
          })
        },
      check_login_data: function (e) {
          e.preventDefault()
          const $this = $(e.target),
              url = this.showLoginDataCodeBlock ?
                  $this.data('action-save') :
                  $this.data('action-check');

          $.ajax({
              beforeSend: function (xhr) {},
              data: $this.serialize(),
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              method: 'POST',
              complete: function () {},
              error: function (response) {
                  $this.find('.error').remove();
                  Profile.parse_error($this, response);
              },
              success: function (response) {
                  if ('success' === response.status) {
                      if (response.needConfirmCode) {
                          Profile.showSmsBlock($this);
                      } else {
                          location.replace(response.redirect);
                      }
                  }
              },
              url: url
          });
      },
      showSmsBlock: function ($form) {
            $form.find('.js__password-block').hide();
            $form.find('.js__sms-block').show();
            this.showLoginDataCodeBlock = true;
      },
      showPasswordBlock: function ($form) {
            $form.find('.js__password-block').show();
            $form.find('.js__sms-block').hide();
            this.showLoginDataCodeBlock = false;
      },
      clearFields: function ($form) {
            $form.find('input[name]').val(null);
      },
    }
    Profile.init()
});
