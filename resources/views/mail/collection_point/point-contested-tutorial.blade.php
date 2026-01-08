<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#f4f6f8; padding:20px;">
    <tr>
        <td align="center">
            <table width="600" cellpadding="0" cellspacing="0" border="0"
                style="background-color:#ffffff; border-radius:6px; overflow:hidden; font-family:Arial, Helvetica, sans-serif;">

                ```
                <!-- Header -->
                <tr>
                    <td style="background-color:#2e7d32; padding:20px; color:#ffffff;">
                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td style="font-size:20px; font-weight:bold;">
                                    Natureza Prioridade Renovada
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- Content -->
                <tr>
                    <td style="padding:24px; color:#333333; font-size:14px; line-height:20px;">
                        <table width="100%" cellpadding="0" cellspacing="0" border="0">

                            <tr>
                                <td style="padding-bottom:16px;">
                                    Olá <strong>{{ $name }}</strong>,
                                </td>
                            </tr>

                            <tr>
                                <td style="padding-bottom:16px;">
                                    Informamos que a <strong>contestação do seu ponto de coleta <strong>{{ $pointName }}</strong> foi registrada com
                                        sucesso</strong>
                                    em nossa plataforma.
                                </td>
                            </tr>

                            <tr>
                                <td style="padding-bottom:16px;">
                                    Pedimos que realize as alterações solicitadas pelo motivo de reprovação em até 7 dias, caso contrário o seu ponto será marcado como reprovado.

                                    A equipe responsável irá analisar as informações enviadas durante o período de
                                    contestação.
                                    Após a conclusão da análise, você será notificado(a) por email sobre a decisão
                                    final.
                                </td>
                            </tr>

                            <!-- Button -->
                            <tr>
                                <td align="center" style="padding:24px 0;">
                                    <table cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                            <td style="background-color:#2e7d32; border-radius:4px;">
                                                <a href="{{ $link }}"
                                                    style="display:inline-block; padding:12px 20px; color:#ffffff; text-decoration:none; font-size:14px; font-weight:bold;">
                                                    Acompanhar ponto de coleta
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td style="padding-bottom:16px;">
                                    Recomendamos que acompanhe o status do ponto de coleta pelo link acima,
                                    onde eventuais atualizações estarão disponíveis.
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Agradecemos sua participação e contribuição para a melhoria contínua da plataforma.
                                </td>
                            </tr>

                        </table>
                    </td>
                </tr>

                <!-- Footer -->
                <tr>
                    <td style="background-color:#f1f1f1; padding:16px; font-size:12px; color:#666666;">
                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td align="center">
                                    © {{ now()->format('Y') }} Natureza Prioridade Renovada<br>
                                    Este é um email automático, por favor não responda.
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

            </table>
        </td>
    </tr>
    ```

</table>
